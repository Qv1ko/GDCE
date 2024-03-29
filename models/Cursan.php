<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cursan".
 *
 * @property int $id_cursa
 * @property string $curso_academico
 * @property int|null $id_alumno
 * @property int|null $id_curso
 *
 * @property Alumnos $alumno
 * @property Cursos $curso
 */
class Cursan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cursan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['curso_academico'], 'required'],
            [['id_alumno', 'id_curso'], 'integer'],
            [['curso_academico'], 'string', 'max' => 8],
            [['id_alumno', 'id_curso'], 'unique', 'targetAttribute' => ['id_alumno', 'id_curso']],
            [['id_alumno'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['id_alumno' => 'id_alumno']],
            [['id_curso'], 'exist', 'skipOnError' => true, 'targetClass' => Cursos::class, 'targetAttribute' => ['id_curso' => 'id_curso']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cursa' => 'Id Cursa',
            'curso_academico' => 'Curso Academico',
            'id_alumno' => 'Id Alumno',
            'id_curso' => 'Id Curso',
        ];
    }

    /**
     * Gets query for [[Alumno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumno()
    {
        return $this->hasOne(Alumnos::class, ['id_alumno' => 'id_alumno']);
    }

    /**
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Cursos::class, ['id_curso' => 'id_curso']);
    }

    /**
     * Devuelve el año académico actual "aaaa/aa".
     * Si la fecha actual está después de septiembre, el año actual y el siguiente se consideran como el año académico actual.
     * Si la fecha actual está antes de septiembre, el año anterior y el actual se consideran como el año académico actual.
     * 
     * @return string El año académico actual en el formato "aaaa/aa".
     */
    public function getCursoActual() {
        
        // Año actual
        $anoActual = date('Y');
        
        // Verificar si la fecha actual está después de septiembre
        if (date('n') > 8) {
            // Si es después de septiembre, el año actual y el siguiente se consideran como el año académico actual
            $cursoEscolarActual = $anoActual . '/' . substr($anoActual, 2, 2);
        } else {
            // Si es antes de septiembre, el año anterior y el actual se consideran como el año académico actual
            $cursoEscolarActual = ($anoActual - 1) . '/' . substr($anoActual, 2, 2);
        }
        
        // Devolver el año académico actual
        return $cursoEscolarActual;

    }

}
