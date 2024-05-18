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
 * @property Cargan[] $Cargan
 * @property Portatiles[] $Portatil
 */
class Cargadores extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'cargadores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['codigo', 'estado'], 'required', 'message' => '⚠️ Este campo es obligatorio'],
            [['potencia', 'id_almacen'], 'integer'],
            [['codigo'], 'string', 'max' => 4],
            [['codigo'], 'match', 'pattern' => '/^\d{3}[A-Z]$/', 'message' => '⚠️ El código debe seguir el siguiente formato de ejemplo: "123A"'],
            [['estado'], 'string', 'max' => 24],
            [['estado'], 'in', 'range' => ['Disponible', 'No disponible', 'Averiado'], 'message' => '⚠️ El estado solo puede ser "Disponible", "No disponible" o "Averiado"'],
            [['codigo'], 'unique'],
            [['id_almacen'], 'exist', 'skipOnError' => true, 'targetClass' => Almacenes::class, 'targetAttribute' => ['id_almacen' => 'id_almacen']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_cargador' => 'ID del cargador',
            'codigo' => 'Código',
            'potencia' => 'Vatios de potencia',
            'estado' => 'Estado',
            'id_almacen' => 'ID del almacen',
        ];
    }

    /**
     * Gets query for [[Almacen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlmacen() {
        return $this->hasOne(Almacenes::class, ['id_almacen' => 'id_almacen']);
    }

    /**
     * Gets query for [[Cargan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargan() {
        return $this->hasMany(Cargan::class, ['id_cargador' => 'id_cargador']);
    }

    /**
     * Gets query for [[Portatil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortatil() {
        return $this->hasMany(Portatiles::class, ['id_portatil' => 'id_portatil'])->viaTable('cargan', ['id_cargador' => 'id_cargador']);
    }

    public static function sincronizarCargadores() {

        $cargadores = Cargadores::find()->all();
    
        foreach ($cargadores as $cargador) {
            if ($cargador->estado === 'Averiado') {
                continue;
            }
    
            $carga = Cargan::findOne(['id_cargador' => $cargador->id_cargador]);
    
            if ($carga) {
                $cargador->estado = 'No disponible';
            } else {
                $cargador->estado = 'Disponible';
            }
    
            $cargador->save();
        }

    }

}
