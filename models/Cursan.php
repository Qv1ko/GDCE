<?php

namespace app\models;

use Yii;

/**
 * Esta es la clase modelo para la tabla "cursan".
 *
 * @property int $id_cursa
 * @property string $curso_academico
 * @property int|null $id_alumno
 * @property int|null $id_curso
 *
 * @property Alumnos $alumno
 * @property Cursos $curso
 */
class Cursan extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'cursan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        // Reglas de validación para los atributos del modelo
        return [
            [['curso_academico'], 'required', 'message' => '⚠️ Este campo es obligatorio'],
            [['id_alumno', 'id_curso'], 'integer'],
            [['curso_academico'], 'string', 'max' => 8],
            [['curso_academico'], 'match', 'pattern' => '/^[0-9]{4}\/[0-9]{2}$/', 'message' => '⚠️ Formato incorrecto (ej: 2023/24)'],
            [['id_alumno', 'id_curso'], 'unique', 'targetAttribute' => ['id_alumno', 'id_curso']],
            [['id_alumno'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['id_alumno' => 'id_alumno']],
            [['id_curso'], 'exist', 'skipOnError' => true, 'targetClass' => Cursos::class, 'targetAttribute' => ['id_curso' => 'id_curso']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_cursa' => 'ID Cursa',
            'curso_academico' => 'Curso académico',
            'id_alumno' => 'Alumno',
            'id_curso' => 'Curso',
        ];
    }

    /**
     * Obtiene la consulta para [[Alumno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumno() {
        return $this->hasOne(Alumnos::class, ['id_alumno' => 'id_alumno']);
    }

    /**
     * Obtiene la consulta para [[Curso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurso() {
        return $this->hasOne(Cursos::class, ['id_curso' => 'id_curso']);
    }

    /**
     * Devuelve el año académico actual "aaaa/aa".
     * Si la fecha actual está después de septiembre, el año actual y el siguiente se consideran como el año académico actual.
     * Si la fecha actual está antes de septiembre, el año anterior y el actual se consideran como el año académico actual.
     * 
     * @return string El año académico actual en el formato "aaaa/aa".
     */
    public static function getCursoActual() {

        // Año actual
        $anoActual = date('Y');

        // Verificar si la fecha actual está después de septiembre
        if (date('n') > 8) {
            // Si es después de septiembre, el año actual y el siguiente se consideran como el año académico actual
            $cursoEscolarActual = $anoActual . '/' . substr($anoActual + 1, 2, 2);
        } else {
            // Si es antes de septiembre, el año anterior y el actual se consideran como el año académico actual
            $cursoEscolarActual = ($anoActual - 1) . '/' . substr($anoActual, 2, 2);
        }

        return $cursoEscolarActual;

    }

    /**
     * Sincroniza los registros de la tabla "cursan".
     */
    public static function sincronizarCursan() {

        // Matriculaciones de alumnos ya no matriculados
        $cursanNoMatriculados = Cursan::find()->innerJoin('alumnos', 'cursan.id_alumno = alumnos.id_alumno')->where(['estado_matricula' => 'No matriculado'])->all();

        // Alumnos que están matriculados en varios cursos con el mismo turno y curso académico
        $amvc = Cursan::find()->select('id_alumno')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->groupBy(['id_alumno', 'curso_academico', 'cursos.turno'])->having('COUNT(*) > 1');

        // Últimos cursos en los que se han matriculado
        $ucm = Cursan::find()->select('MAX(id_cursa)')->innerJoin('cursos', 'cursan.id_curso = cursos.id_curso')->where('id_alumno = cursan.id_alumno')->groupBy(['id_alumno', 'curso_academico', 'cursos.turno']);

        // Antiguas matriculaciones
        $am = Cursan::find()->where(['id_alumno' => $amvc])->andWhere(['not in', 'id_cursa', $ucm])->all();

        // Elimina las matriculaciones de alumnos ya no matriculados
        foreach ($cursanNoMatriculados as $cursa) {
            $cursa->delete();
        }

        // Elimina las antiguas matriculaciones
        foreach ($am as $model) {
            $model->delete();
        }

    }

}
