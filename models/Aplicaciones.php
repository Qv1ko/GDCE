<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aplicaciones".
 *
 * @property int $id_aplicacion
 * @property string $aplicacion
 * @property int|null $id_portatil
 *
 * @property Portatiles $portatil
 */
class Aplicaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aplicaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aplicacion'], 'required'],
            [['id_portatil'], 'integer'],
            [['aplicacion'], 'string', 'max' => 32],
            [['aplicacion', 'id_portatil'], 'unique', 'targetAttribute' => ['aplicacion', 'id_portatil']],
            [['id_portatil'], 'exist', 'skipOnError' => true, 'targetClass' => Portatiles::class, 'targetAttribute' => ['id_portatil' => 'id_portatil']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_aplicacion' => 'Id Aplicacion',
            'aplicacion' => 'Aplicacion',
            'id_portatil' => 'Id Portatil',
        ];
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
