<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cargadores".
 *
 * @property int $id_cargador
 * @property string $codigo
 * @property int|null $potencia
 * @property string $estado
 * @property int|null $id_almacen
 *
 * @property Almacenes $almacen
 * @property Cargan[] $cargans
 * @property Portatiles[] $portatils
 */
class Cargadores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cargadores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'estado'], 'required'],
            [['potencia', 'id_almacen'], 'integer'],
            [['codigo'], 'string', 'max' => 4],
            [['estado'], 'string', 'max' => 24],
            [['codigo'], 'unique'],
            [['id_almacen'], 'exist', 'skipOnError' => true, 'targetClass' => Almacenes::class, 'targetAttribute' => ['id_almacen' => 'id_almacen']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cargador' => 'Id Cargador',
            'codigo' => 'Codigo',
            'potencia' => 'Potencia',
            'estado' => 'Estado',
            'id_almacen' => 'Id Almacen',
        ];
    }

    /**
     * Gets query for [[Almacen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlmacen()
    {
        return $this->hasOne(Almacenes::class, ['id_almacen' => 'id_almacen']);
    }

    /**
     * Gets query for [[Cargans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargans()
    {
        return $this->hasMany(Cargan::class, ['id_cargador' => 'id_cargador']);
    }

    /**
     * Gets query for [[Portatils]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortatils()
    {
        return $this->hasMany(Portatiles::class, ['id_portatil' => 'id_portatil'])->viaTable('cargan', ['id_cargador' => 'id_cargador']);
    }
}
