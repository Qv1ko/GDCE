<?php

namespace app\models;

use Yii;
use app\models\Portatiles;

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
            [['dni', 'nombre', 'estado_matricula'], 'required'],
            [['id_portatil'], 'integer'],
            [['dni'], 'string', 'max' => 8],
            [['nombre'], 'string', 'max' => 24],
            [['apellidos'], 'string', 'max' => 48],
            [['estado_matricula'], 'string', 'max' => 16],
            [['dni'], 'unique'],
            [['id_portatil'], 'exist', 'skipOnError' => true, 'targetClass' => Portatiles::class, 'targetAttribute' => ['id_portatil' => 'id_portatil']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_alumno' => 'ID Alumno',
            'dni' => 'DNI',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'estado_matricula' => 'Estado Matricula',
            'id_portatil' => 'ID Portatil',
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

    /**
     * Gets query for [[Portatil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortatil() {
        return $this->hasOne(Portatiles::class, ['id_portatil' => 'id_portatil']);
    }

    public function getAlumnosManana() {
        $am = Alumnos::find()->select(['CONCAT(alumnos.nombre, " ", alumnos.apellidos) AS alumno', 'id_portatil'])->distinct()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Mañana', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual()]);
        return $am;
    }

    public function getAlumnosTarde() {
        $at = Alumnos::find()->select(['CONCAT(alumnos.nombre, " ", alumnos.apellidos) AS alumno', 'id_portatil'])->distinct()->innerJoin('cursan', 'alumnos.id_alumno = cursan.id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where(['turno' => 'Tarde', 'estado_matricula' => 'Matriculado', 'curso_academico' => Cursan::getCursoActual()]);
        return $at;
    }

    public static function sincronizar() {

        $alumnos = Alumnos::find()->all();
        $estadoPortatil = '';

        foreach ($alumnos as $alumno) {

            $estadoPortatil = Portatiles::find()->select('estado')->distinct()->where(['id_portatil' => $alumno->id_portatil]);
            
            if ($alumno->estado_matricula !== 'Matriculado') {
                $alumno->id_portatil = null;
            }
            if ($estadoPortatil === 'Averiado') {
                $alumno->id_portatil = null;
            }

            $alumno->save();

        }

    }


}
