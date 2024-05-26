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
class Aplicaciones extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'aplicaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['aplicacion'], 'required', 'message' => '⚠️ Este campo es obligatorio'],
            [['id_portatil'], 'integer'],
            [['aplicacion'], 'string', 'max' => 32],
            [['aplicacion'], 'match', 'pattern' => '/^[a-zA-Z ]+$/', 'message' => '⚠️ La marca solo puede contener caracteres alfabéticos'],
            [['aplicacion', 'id_portatil'], 'unique', 'targetAttribute' => ['aplicacion', 'id_portatil']],
            [['id_portatil'], 'exist', 'skipOnError' => true, 'targetClass' => Portatiles::class, 'targetAttribute' => ['id_portatil' => 'id_portatil']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_aplicacion' => 'ID de la aplicación',
            'aplicacion' => 'Aplicación',            
            'id_portatil' => 'Portátil',
        ];
    }

    /**
     * Gets query for [[Portatil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortatil() {
        return $this->hasOne(Portatiles::class, ['id_portatil' => 'id_portatil']);
    }

    public static function getListaAplicaciones() {
        $aplicaciones = array_unique(array_column(Aplicaciones::find()->asArray()->all(), 'aplicacion'));
        return array_chunk($aplicaciones, ceil(count($aplicaciones) / 16));
    }

}
