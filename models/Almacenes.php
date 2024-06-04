<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\validators\NumberValidator;

/**
 * Esta es la clase de modelo para la tabla "almacenes".
 * @property int $id_almacen
 * @property string $aula
 * @property int|null $capacidad
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
            [['aula'], 'required', 'message' => '⚠️ Campo obligatorio'],
            [['aula'], 'string', 'max' => 4],
            [['aula'], 'match', 'pattern' => '/^\d{3}[A-Z]$/', 'message' => '⚠️ Formato incorrecto'],
            [['aula'], 'unique', 'message' => '⚠️ Ya existe'],
            [['capacidad'], 'integer', 'message' => '⚠️ Formato incorrecto'],
            [['capacidad'], NumberValidator::class, 'min' => 0, 'tooSmall' => '⚠️ Valores negativos'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_almacen' => 'Almacén',
            'aula' => 'Código del aula',
            'capacidad' => 'Capacidad máxima',
        ];
    }

    /**
     * Obtiene la consulta para [[Cargadores]].
     * @return \yii\db\ActiveQuery
     */
    public function getCargadores() {
        return $this->hasMany(Cargadores::class, ['id_almacen' => 'id_almacen']);
    }

    /**
     * Obtiene la consulta para [[Portatiles]].
     * @return \yii\db\ActiveQuery
     */
    public function getPortatiles() {
        return $this->hasMany(Portatiles::class, ['id_almacen' => 'id_almacen']);
    }
    
    public static function getOcupacion($id) {
        return Portatiles::find()->where(['id_almacen' => $id])->count() + Cargadores::find()->where(['id_almacen' => $id])->count();
    }
    
    public static function getAlmacenesDisponibles() {
        return ArrayHelper::map(Almacenes::find()->select(['id_almacen', 'aula'])->where(['>', 'capacidad', new Expression('(SELECT COUNT(*) FROM portatiles WHERE id_almacen = almacenes.id_almacen) + (SELECT COUNT(*) FROM cargadores WHERE id_almacen = almacenes.id_almacen)')])->all(), 'id_almacen', 'aula');
    }

}
