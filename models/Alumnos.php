<?php

namespace app\models;

use Yii;

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
class Alumnos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alumnos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
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
    public function attributeLabels()
    {
        return [
            'id_alumno' => 'Id Alumno',
            'dni' => 'Dni',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'estado_matricula' => 'Estado Matricula',
            'id_portatil' => 'Id Portatil',
        ];
    }

    /**
     * Gets query for [[Cursan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursan()
    {
        return $this->hasMany(Cursan::class, ['id_alumno' => 'id_alumno']);
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Cursos::class, ['id_curso' => 'id_curso'])->viaTable('cursan', ['id_alumno' => 'id_alumno']);
    }

    /**
     * Gets query for [[Portatil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortatil()
    {
        return $this->hasOne(Portatiles::class, ['id_portatil' => 'id_portatil']);
    }
}
