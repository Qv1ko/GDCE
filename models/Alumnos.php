<?php

namespace app\models;

use Yii;
use app\models\Portatiles;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "alumnos".
 *
 * @property int $id_alumno
 * @property string $dni
 * @property string $nombre
 * @property string|null $apellidos
 * @property string $estado_matricula
 * @property int|null $id_portatil
 *
 * @property Cursan[] $cursan
 * @property Cursos[] $cursos
 * @property Portatiles $portatil
 */
class Alumnos extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'alumnos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['dni', 'nombre', 'estado_matricula'], 'required', 'message' => '⚠️ Este campo es obligatorio'],
            [['dni'], 'string', 'max' => 9],
            [['dni'], 'match', 'pattern' => '/^[XYZ]\d{7}[A-Z]$|^\d{8}[A-Z]$/', 'message' => '⚠️ El formato del DNI/NIE es incorrecto (ej: 12345678Z, X12345678Z)'],
            [['dni'], 'validarDni'],
            [['nombre'], 'string', 'max' => 24],
            [['nombre'], 'match', 'pattern' => '/^[a-zA-ZÁÉÍÓÚÑáéíóúñ ]+$/', 'message' => '⚠️ El nombre solo puede contener caracteres alfabéticos'],
            [['apellidos'], 'string', 'max' => 48],
            [['apellidos'], 'match', 'pattern' => '/^[a-zA-ZÁÉÍÓÚÑáéíóúñ ]+$/', 'message' => '⚠️ El apellido solo puede contener caracteres alfabéticos'],
            [['estado_matricula'], 'string', 'max' => 16],
            [['estado_matricula'], 'in', 'range' => ['Matriculado', 'No matriculado'], 'message' => '⚠️ El estado de la matrícula solo puede ser "Matriculado" o "No matriculado"'],
            [['dni'], 'unique', 'message' => '⚠️ El DNI ya esta registrado'],
            [['nombre', 'apellidos'], 'unique', 'targetAttribute' => ['nombre', 'apellidos'], 'message' => '⚠️ El alumno ya existe'],
            [['id_portatil'], 'exist', 'skipOnError' => true, 'targetClass' => Portatiles::class, 'targetAttribute' => ['id_portatil' => 'id_portatil']],
        ];
    }

    public function validarDni($attribute, $params) {

        if (preg_match('/^[0-9]{8}[A-Z]$/', $this->$attribute)) {
            $validacion = $this->validarFormatoDni($this->$attribute);
            if ($validacion !== true) {
                $this->addError($attribute, "⚠️ El DNI es incorrecto");
            }
        } elseif (preg_match('/^[XYZ]\d{7,8}[A-Z]$/', $this->$attribute)) {
            $validacion = $this->validarFormatoNie($this->$attribute);
            if ($validacion !== true) {
                $this->addError($attribute, "⚠️ El NIE es incorrecto");
            }
        } else {
            $this->addError($attribute, "⚠️ El DNI/NIE es incorrecto");
        }

    }
    
    public function validarFormatoDni($dni) {

        $numero = substr($dni, 0, -1);
        $letra = substr($dni, -1);
        $letraCorrecta = $this->getLetraDni($numero);
    
        return $letra == $letraCorrecta;

    }
    
    public function validarFormatoNie($nie) {

        $letraInicial = substr($nie, 0, 1);
        $numero = substr($nie, 1, -1);
        $letra = substr($nie, -1);

        if ($letraInicial == 'X' || $letraInicial == 'Y' || $letraInicial == 'Z') {
            $letraInicial = str_replace(['X', 'Y', 'Z'], ['0', '1', '2'], $letraInicial);
            $numero = $letraInicial . $numero;
        }

        $letraCorrecta = $this->getLetraDni($numero);
        
        return $letra == $letraCorrecta;

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_alumno' => 'Alumno/a',
            'dni' => 'DNI o NIE del alumno/a',
            'nombre' => 'Nombre del alumno/a',
            'apellidos' => 'Apellidos del alumno/a',
            'estado_matricula' => 'Estado de la matrícula',
            'id_portatil' => 'Portátil',
        ];
    }

    /**
     * Gets query for [[Cursan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursan() {
        return $this->hasMany(Cursan::class, ['id_alumno' => 'id_alumno']);
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos() {
        return $this->hasMany(Cursos::class, ['id_curso' => 'id_curso'])->viaTable('cursan', ['id_alumno' => 'id_alumno']);
    }

    public function getCursoManana() {
        return $this->hasOne(Cursos::class, ['id_curso' => 'id_curso'])->viaTable('cursan', ['id_alumno' => 'id_alumno'])->onCondition(['turno' => 'Mañana']);
    }

    public function getCursoTarde() {
        return $this->hasOne(Cursos::class, ['id_curso' => 'id_curso'])->viaTable('cursan', ['id_alumno' => 'id_alumno'])->onCondition(['turno' => 'Tarde']);
    }

    /**
     * Gets query for [[Portatil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortatil() {
        return $this->hasOne(Portatiles::class, ['id_portatil' => 'id_portatil']);
    }

    public function getNombreCompleto() {
        return $this->nombre . ' ' . $this->apellidos;
    }

    public static function getAlumnosManana() {
        return Alumnos::find()->select(['CONCAT(alumnos.nombre, " ", alumnos.apellidos) AS alumno', 'alumnos.id_alumno', 'alumnos.id_portatil'])->distinct()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Mañana', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual()]);
    }

    public static function getAlumnosTarde() {
        return Alumnos::find()->select(['CONCAT(alumnos.nombre, " ", alumnos.apellidos) AS alumno', 'alumnos.id_alumno', 'alumnos.id_portatil'])->distinct()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Tarde', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual()]);
    }

    public static function getListaAlumnosManana() {
        return ArrayHelper::map(Alumnos::find()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Mañana', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual(), 'id_portatil' => null])->all(), 'id_alumno', 'nombreCompleto');
    }
    
    public static function getListaAlumnosTarde() {
        return ArrayHelper::map(Alumnos::find()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Tarde', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual(), 'id_portatil' => null])->all(), 'id_alumno', 'nombreCompleto');
    }
    

    private function getLetraDni($dni) {
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        $posicion = $dni % 23;
        return $letras[$posicion];
    }

    public function setDni($dni) {

        $numero = '';
        $letraCorrecta = '';

        if (preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
            $numero = substr($dni, 0, -1);
            $letraCorrecta = $this->getLetraDni($numero);
        } elseif (preg_match('/^[XYZ]\d{7,8}[A-Z]$/', $dni)) {
            $letraInicial = substr($dni, 0, 1);
            $numero = substr($dni, 1, -1);
            $letraCorrecta = $this->getLetraDni($numero);

            if ($letraInicial == 'X' || $letraInicial == 'Y' || $letraInicial == 'Z') {
                $letraInicial = strtoupper($letraInicial);
                $numero = $letraInicial . $numero;
            }
        }

        return $numero . $letraCorrecta;

    }

    public static function sincronizarAlumnos() {

        $alumnos = Alumnos::find()->all();
    
        foreach ($alumnos as $alumno) {

            $existe = Alumnos::find()->where(['nombre' => $alumno->nombre, 'apellidos' => $alumno->apellidos])->orWhere(['dni' => $alumno->dni])->andWhere(['!=', 'id_alumno', $alumno->id_alumno])->exists();

            if ($existe) {
                $alumno->delete();
                continue;
            }
            if (!$alumno->validarFormatoDni($alumno->dni)) {
                $alumno->dni = $alumno->setDni($alumno->dni);
            }
            if (empty($alumno->cursan) || empty($alumno->cursos)) {
                $alumno->estado_matricula = 'No matriculado';
            }
            if ($alumno->estado_matricula !== 'Matriculado') {
                $alumno->id_portatil = null;
            }
            if ($alumno->portatil !== null && $alumno->portatil->estado === 'Averiado') {
                $alumno->id_portatil = null;
            }

            $alumno->save();
    
        }
    
    }

}
