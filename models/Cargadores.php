<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\validators\NumberValidator;

/**
 * Esta es la clase modelo para la tabla "cargadores".
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
        // Reglas de validación para los atributos del modelo
        return [
            [['codigo', 'estado'], 'required', 'message' => '⚠️ Campo obligatorio'],
            [['potencia', 'id_almacen'], 'integer'],
            [['potencia'], NumberValidator::class, 'min' => 1, 'message' => '⚠️ El valor no puede ser menor de 1'],
            [['codigo'], 'string', 'max' => 4],
            [['codigo'], 'match', 'pattern' => '/^\d{3}[A-Z]$/', 'message' => '⚠️ Formato incorrecto'],
            [['estado'], 'string', 'max' => 24],
            [['estado'], 'in', 'range' => ['Disponible', 'No disponible', 'Averiado'], 'message' => '⚠️ Solo puede ser "Disponible", "No disponible" o "Averiado"'],
            [['codigo'], 'unique', 'message' => '⚠️ Ya existe'],
            [['id_almacen'], 'exist', 'skipOnError' => true, 'targetClass' => Almacenes::class, 'targetAttribute' => ['id_almacen' => 'id_almacen']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_cargador' => 'Cargador',
            'codigo' => 'Código',
            'potencia' => 'Vatios de potencia',
            'estado' => 'Estado',
            'id_almacen' => 'Almacén',
        ];
    }

    /**
     * Obtiene la consulta para [[Almacen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlmacen() {
        return $this->hasOne(Almacenes::class, ['id_almacen' => 'id_almacen']);
    }

    /**
     * Obtiene la consulta para [[Cargan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargan() {
        return $this->hasMany(Cargan::class, ['id_cargador' => 'id_cargador']);
    }

    /**
     * Obtiene la consulta para [[Portatil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortatil() {
        return $this->hasMany(Portatiles::class, ['id_portatil' => 'id_portatil'])->viaTable('cargan', ['id_cargador' => 'id_cargador']);
    }

    /**
     * Devuelve una lista de los cargadores con estado disponibles.
     *
     * @return array
     */
    public static function getCargadoresDisponibles() {
        $cargadores = ArrayHelper::map(Cargadores::find()->where(['estado' => 'Disponible'])->all(), 'id_cargador', 'codigo');
        asort($cargadores);
        return $cargadores;
    }

    /**
     * Devuelve una lista de los cargadores que no tienen una relación con portátiles.
     *
     * @return array
     */
    public static function getCargadoresLibres() {
        $cargadores = ArrayHelper::map(Cargadores::find()->leftJoin('cargan', 'cargadores.id_cargador = cargan.id_cargador')->where(['estado' => 'Disponible', 'id_carga' => null])->all(), 'id_cargador', 'codigo');
        asort($cargadores);
        return $cargadores;
    }

    /**
     * Devuelve una lista de los cargadores libres y el cargador actual.
     *
     * @param int $idCargador
     * @return array
     */
    public static function getCargadoresLibresmca($idCargador) {
        $cargadores = ArrayHelper::map(Cargadores::find()->leftJoin('cargan', 'cargadores.id_cargador = cargan.id_cargador')->where(['estado' => 'Disponible', 'id_carga' => null])->orWhere(['cargadores.id_cargador' => $idCargador])->all(), 'id_cargador', 'codigo');
        asort($cargadores);
        return $cargadores;
    }

    /**
     * Sincroniza los cargadores.
     */
    public static function sincronizarCargadores() {
        $cargadores = Cargadores::find()->all();
        foreach ($cargadores as $cargador) {
            if ($cargador->estado === 'Averiado') {
                continue;
            }
            $cargador->estado = ($cargador->portatil) ? 'No disponible' : 'Disponible';
            $cargador->save();
        }
    }

}
