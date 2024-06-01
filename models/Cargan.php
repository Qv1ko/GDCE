<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cargan".
 *
 * @property int $id_carga
 * @property int|null $id_portatil
 * @property int|null $id_cargador
 *
 * @property Cargadores $cargador
 * @property Portatiles $portatil
 */
class Cargan extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'cargan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id_portatil', 'id_cargador'], 'integer'],
            [['id_portatil', 'id_cargador'], 'unique', 'targetAttribute' => ['id_portatil', 'id_cargador']],
            [['id_cargador'], 'exist', 'skipOnError' => true, 'targetClass' => Cargadores::class, 'targetAttribute' => ['id_cargador' => 'id_cargador']],
            [['id_portatil'], 'exist', 'skipOnError' => true, 'targetClass' => Portatiles::class, 'targetAttribute' => ['id_portatil' => 'id_portatil']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_carga' => 'ID Carga',
            'id_portatil' => 'Portátil',
            'id_cargador' => 'Cargador',
        ];
    }

    /**
     * Gets query for [[Cargador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargador() {
        return $this->hasOne(Cargadores::class, ['id_cargador' => 'id_cargador']);
    }

    /**
     * Gets query for [[Portatil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortatil() {
        return $this->hasOne(Portatiles::class, ['id_portatil' => 'id_portatil']);
    }

    public static function sincronizarCargan() {

        $cargas = Cargan::find()->all();
    
        foreach ($cargas as $carga) {

            $portatil = Portatiles::findOne($carga->id_portatil);
            $cargador = Cargadores::findOne($carga->id_cargador);
    
            if ($portatil && $portatil->estado === 'Averiado') {
                $carga->delete();
                continue;
            }

            if ($cargador && $cargador->estado === 'Averiado') {
                $carga->delete();
                continue;
            }

        }

        //Portatiles con más de una relación
        $pvr = Cargan::find()->select('cargan.id_portatil')->innerJoin('portatiles', 'cargan.id_portatil = portatiles.id_portatil')->groupBy(['id_portatil'])->having('COUNT(*) > 1');
        // Ultima carga
        $uc = Cargan::find()->select('MAX(id_carga)')->innerJoin('portatiles', 'cargan.id_portatil = portatiles.id_portatil')->where('id_cargador = cargan.id_cargador')->groupBy(['cargan.id_portatil'])->all();
        // Antiguas cargas
        $ac = Cargan::find()->where(['id_portatil' => $pvr])->andWhere(['not in', 'id_carga', $uc])->all();

        foreach ($ac as $model) {
            $model->delete();
        }

    }

}
