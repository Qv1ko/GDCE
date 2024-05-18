<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "almacenes".
 *
 * @property int $id_almacen
 * @property string $aula
 * @property int|null $capacidad
 *
 * @property Cargadores[] $cargadores
 * @property Portatiles[] $portatiles
 */
class Almacenes extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'almacenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['aula'], 'required', 'message' => '⚠️ Este campo es obligatorio'],
            [['capacidad'], 'integer'],
            [['aula'], 'string', 'max' => 4],
            [['aula'], 'match', 'pattern' => '/^\d{3}[A-Z]$/', 'message' => '⚠️ El aula debe seguir el siguiente formato de ejemplo: "123N"'],
            [['aula'], 'unique', 'message' => '⚠️ El almacén ya existe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_almacen' => false,
            'aula' => 'Aula',
            'capacidad' => 'Capacidad',
        ];
    }

    /**
     * Gets query for [[Cargadores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargadores() {
        return $this->hasMany(Cargadores::class, ['id_almacen' => 'id_almacen']);
    }

    /**
     * Gets query for [[Portatiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortatiles() {
        return $this->hasMany(Portatiles::class, ['id_almacen' => 'id_almacen']);
    }

}
