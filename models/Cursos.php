<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cursos".
 *
 * @property int $id_curso
 * @property string $nombre
 * @property string|null $nombre_corto
 * @property string $curso
 * @property string $turno
 * @property string $aula
 * @property string $tutor
 *
 * @property Alumnos[] $alumnos
 * @property Cursan[] $cursans
 */
class Cursos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cursos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'curso', 'turno', 'aula', 'tutor'], 'required'],
            [['nombre'], 'string', 'max' => 96],
            [['nombre_corto', 'turno'], 'string', 'max' => 8],
            [['curso'], 'string', 'max' => 16],
            [['aula'], 'string', 'max' => 4],
            [['tutor'], 'string', 'max' => 24],
            [['nombre'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_curso' => 'Id Curso',
            'nombre' => 'Nombre',
            'nombre_corto' => 'Nombre Corto',
            'curso' => 'Curso',
            'turno' => 'Turno',
            'aula' => 'Aula',
            'tutor' => 'Tutor',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumnos::class, ['id_alumno' => 'id_alumno'])->viaTable('cursan', ['id_curso' => 'id_curso']);
    }

    /**
     * Gets query for [[Cursans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursans()
    {
        return $this->hasMany(Cursan::class, ['id_curso' => 'id_curso']);
    }
}
