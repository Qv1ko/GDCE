<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "portatiles".
 *
 * @property int $id_portatil
 * @property string $codigo
 * @property string|null $marca
 * @property string|null $modelo
 * @property string $estado
 * @property string|null $procesador
 * @property int|null $memoria_ram
 * @property int|null $capacidad
 * @property string|null $dispositivo_almacenamiento
 * @property int|null $id_almacen
 *
 * @property Almacenes $almacen
 * @property Alumnos[] $alumnos
 * @property Aplicaciones[] $aplicaciones
 * @property Cargadores[] $cargadors
 * @property Cargan[] $cargans
 */
class Portatiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'portatiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'estado'], 'required'],
            [['memoria_ram', 'capacidad', 'id_almacen'], 'integer'],
            [['codigo'], 'string', 'max' => 4],
            [['marca', 'modelo', 'estado', 'procesador', 'dispositivo_almacenamiento'], 'string', 'max' => 24],
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
            'id_portatil' => 'Id Portatil',
            'codigo' => 'Codigo',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'estado' => 'Estado',
            'procesador' => 'Procesador',
            'memoria_ram' => 'Memoria Ram',
            'capacidad' => 'Capacidad',
            'dispositivo_almacenamiento' => 'Dispositivo Almacenamiento',
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
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumnos::class, ['id_portatil' => 'id_portatil']);
    }

    /**
     * Gets query for [[Aplicaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAplicaciones()
    {
        return $this->hasMany(Aplicaciones::class, ['id_portatil' => 'id_portatil']);
    }

    /**
     * Gets query for [[Cargadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargadors()
    {
        return $this->hasMany(Cargadores::class, ['id_cargador' => 'id_cargador'])->viaTable('cargan', ['id_portatil' => 'id_portatil']);
    }

    /**
     * Gets query for [[Cargans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargans()
    {
        return $this->hasMany(Cargan::class, ['id_portatil' => 'id_portatil']);
    }
}
