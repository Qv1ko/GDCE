<?php

namespace app\models;

use Yii;
use app\models\Portatiles;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * Esta es la clase modelo para la tabla "alumnos".
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
        // Reglas de validación para los atributos del modelo
        return [
            [['dni', 'nombre', 'estado_matricula'], 'required', 'message' => '⚠️ Campo obligatorio'],
            [['dni'], 'string', 'max' => 9],
            [['dni'], 'match', 'pattern' => '/^[XYZ]\d{7}[A-Z]$|^\d{8}[A-Z]$/', 'message' => '⚠️ El formato del DNI/NIE es incorrecto'],
            [['dni'], 'validarDni'],
            [['nombre'], 'string', 'max' => 24],
            [['nombre', 'apellidos'], 'match', 'pattern' => '/^[a-zA-ZÁÉÍÓÚÑáéíóúñ ]+$/', 'message' => '⚠️ Solo puede contener caracteres alfabéticos'],
            [['apellidos'], 'string', 'max' => 48],
            [['estado_matricula'], 'string', 'max' => 16],
            [['estado_matricula'], 'in', 'range' => ['Matriculado', 'No matriculado'], 'message' => '⚠️ Solo puede ser "Matriculado" o "No matriculado"'],
            [['dni'], 'unique', 'message' => '⚠️ Ya está registrado'],
            [['nombre', 'apellidos'], 'unique', 'targetAttribute' => ['nombre', 'apellidos'], 'message' => '⚠️ Ya existe'],
            [['id_portatil'], 'exist', 'skipOnError' => true, 'targetClass' => Portatiles::class, 'targetAttribute' => ['id_portatil' => 'id_portatil']],
        ];
    }

    // Validación personalizada para el DNI/NIE
    public function validarDni($attribute, $params) {
        if (preg_match('/^[0-9]{8}[A-Z]$/', $this->$attribute)) {
            $validacion = $this->validarFormatoDni($this->$attribute);
            if ($validacion !== true) {
                $this->addError($attribute, "⚠️ DNI incorrecto");
            }
        } elseif (preg_match('/^[XYZ]\d{7,8}[A-Z]$/', $this->$attribute)) {
            $validacion = $this->validarFormatoNie($this->$attribute);
            if ($validacion !== true) {
                $this->addError($attribute, "⚠️ NIE incorrecto");
            }
        } else {
            $this->addError($attribute, "⚠️ DNI/NIE incorrecto");
        }
    }

    // Valida el formato del DNI
    public function validarFormatoDni($dni) {
        $numero = substr($dni, 0, -1);
        $letra = substr($dni, -1);
        $letraCorrecta = $this->getLetraDni($numero);
        return $letra == $letraCorrecta;
    }

    // Valida el formato del NIE
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
     * Obtiene la consulta para [[Cursan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursan() {
        // Relación con el modelo Cursan
        return $this->hasMany(Cursan::class, ['id_alumno' => 'id_alumno']);
    }

    /**
     * Obtiene la consulta para [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos() {
        return $this->hasMany(Cursos::class, ['id_curso' => 'id_curso'])->viaTable('cursan', ['id_alumno' => 'id_alumno']);
    }

    // Relación con el modelo Cursos para los cursos de mañana
    public function getCursoManana() {
        return $this->hasOne(Cursos::class, ['id_curso' => 'id_curso'])->viaTable('cursan', ['id_alumno' => 'id_alumno'])->onCondition(['turno' => 'Mañana']);
    }

    // Relación con el modelo Cursos para los cursos de tarde
    public function getCursoTarde() {
        return $this->hasOne(Cursos::class, ['id_curso' => 'id_curso'])->viaTable('cursan', ['id_alumno' => 'id_alumno'])->onCondition(['turno' => 'Tarde']);
    }

    /**
     * Obtiene la consulta para [[Portatil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortatil() {
        return $this->hasOne(Portatiles::class, ['id_portatil' => 'id_portatil']);
    }

    // Devuelve el nombre completo del alumno
    public function getNombreCompleto() {
        return $this->nombre . ' ' . $this->apellidos;
    }

    // Obtiene los alumnos matriculados en los cursos de la mañana
    public static function getAlumnosManana() {
        return Alumnos::find()->select(['CONCAT(alumnos.nombre, " ", alumnos.apellidos) AS alumno', 'alumnos.id_alumno', 'alumnos.id_portatil'])->distinct()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Mañana', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual()]);
    }

    // Obtiene los alumnos matriculados en los cursos de la tarde
    public static function getAlumnosTarde() {
        return Alumnos::find()->select(['CONCAT(alumnos.nombre, " ", alumnos.apellidos) AS alumno', 'alumnos.id_alumno', 'alumnos.id_portatil'])->distinct()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Tarde', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual()]);
    }

    // Obtiene la lista de alumnos de la mañana sin portátil asignado
    public static function getListaAlumnosManana() {
        $lista = ArrayHelper::map(Alumnos::find()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Mañana', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual(), 'id_portatil' => null])->all(), 'id_alumno', 'nombreCompleto');
        asort($lista);
        return $lista;
    }

    // Obtiene la lista de alumnos que solo están matriculados en cursos de la mañana
    public static function getListaAlumnosSoloManana() {
        $subqueryTarde = (new Query())->select('id_alumno')->from('cursan')->leftJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Tarde', 'curso_academico' => Cursan::getCursoActual()])->distinct();
        $alumnosManana = Alumnos::find()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Mañana', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual()])->andWhere(['not in', 'alumnos.id_alumno', $subqueryTarde])->all();
        $lista = ArrayHelper::map($alumnosManana, 'id_alumno', 'nombreCompleto');
        asort($lista);
        return $lista;
    }

    // Obtiene la lista de alumnos de la tarde sin portátil asignado
    public static function getListaAlumnosTarde() {
        $lista = ArrayHelper::map(Alumnos::find()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Tarde', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual(), 'id_portatil' => null])->all(), 'id_alumno', 'nombreCompleto');
        asort($lista);
        return $lista;
    }

    // Obtiene la lista de alumnos que solo están matriculados en cursos de la tarde
    public static function getListaAlumnosSoloTarde() {
        $subqueryManana = (new Query())->select('id_alumno')->from('cursan')->leftJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Mañana', 'curso_academico' => Cursan::getCursoActual()])->distinct();
        $alumnosTarde = Alumnos::find()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Tarde', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual()])->andWhere(['not in', 'alumnos.id_alumno', $subqueryManana])->all();
        $lista = ArrayHelper::map($alumnosTarde, 'id_alumno', 'nombreCompleto');
        asort($lista);
        return $lista;
    }

    // Obtiene la letra correspondiente del número del DNI
    private function getLetraDni($dni) {
        $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $numero = (int) $dni;
        $indice = $numero % 23;
        return $letras[$indice];
    }

    // Establece el DNI con la letra correcta
    public function setDni($dni) {

        $numero = substr($dni, 0, -1);

        if (!ctype_digit($numero)) {
            $this->dni = $dni;
            return;
        }

        $letra = substr($dni, -1);
        $letraCorrecta = $this->getLetraDni($numero);

        if ($letra !== $letraCorrecta) {
            $this->dni = $numero . $letraCorrecta;
        } else {
            $this->dni = $dni;
        }

    }

    // Sincroniza los alumnos
    public static function sincronizarAlumnos() {

        $alumnos = Alumnos::find()->all();
        $alumnosMap = [];

        foreach ($alumnos as $alumno) {
            $nombreCompleto = $alumno->nombre . ' ' . $alumno->apellidos;
            if (isset($alumnosMap[$nombreCompleto])) {
                // Si ya existe un alumno con el mismo nombre completo, eliminar duplicado
                $alumnoDuplicado = $alumnosMap[$nombreCompleto];
                if ($alumnoDuplicado->estado_matricula == 'No matriculado' && $alumno->estado_matricula == 'Matriculado') {
                    // Si el alumno actual está matriculado y el duplicado no, actualizar el duplicado
                    $alumnoDuplicado->estado_matricula = 'Matriculado';
                    $alumnoDuplicado->save();
                    $alumno->delete();
                } elseif ($alumnoDuplicado->estado_matricula == 'Matriculado' && $alumno->estado_matricula == 'No matriculado') {
                    // Si el duplicado está matriculado y el alumno actual no, eliminar el alumno actual
                    $alumno->delete();
                } elseif ($alumnoDuplicado->estado_matricula == 'Matriculado' && $alumno->estado_matricula == 'Matriculado') {
                    // Si ambos están matriculados, eliminar el duplicado
                    $alumnoDuplicado->delete();
                }
            } else {
                // Si no existe un duplicado, añadir al mapa
                $alumnosMap[$nombreCompleto] = $alumno;
            }
        }

    }

}

?>
