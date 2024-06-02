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
            [['aplicacion'], 'required', 'message' => '⚠️ Campo es obligatorio'],
            [['id_portatil'], 'integer'],
            [['aplicacion'], 'string', 'max' => 32],
            [['aplicacion'], 'match', 'pattern' => '/^[^\/:*?"<>|]*[^\/:*?"<>|\.\s]$/', 'message' => '⚠️ Contiene caracteres invalidos'],
            [['aplicacion', 'id_portatil'], 'unique', 'targetAttribute' => ['aplicacion', 'id_portatil'], 'message' => '⚠️ La aplicación ya existe'],
            [['id_portatil'], 'exist', 'skipOnError' => true, 'targetClass' => Portatiles::class, 'targetAttribute' => ['id_portatil' => 'id_portatil']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_aplicacion' => 'ID de la aplicación',
            'aplicacion' => 'Nombre de la aplicación',            
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
        $aplicaciones = array_unique(array_column(Aplicaciones::find()->where(['id_portatil' => null])->orderBy(['aplicacion' => SORT_ASC])->asArray()->all(), 'aplicacion'));
        return (empty($aplicaciones)) ? [] : array_chunk($aplicaciones, ceil(count($aplicaciones) / 3));
    }

    public static function sincronizarAplicaciones() {

        // Obtener todas las aplicaciones con id_portatil = null
        $aplicaciones = Aplicaciones::find()->where(['id_portatil' => null])->all();
    
        foreach ($aplicaciones as $app) {

            // Contar el número de registros por aplicación
            $nr = Aplicaciones::find()->where(['aplicacion' => $app->aplicacion, 'id_portatil' => null])->count();
    
            if ($nr > 1) {

                // Encontrar la primera (más antigua) aplicación del grupo
                $primeraAplicacion = Aplicaciones::find()->where(['aplicacion' => $app->aplicacion])->andWhere(['id_portatil' => null])->orderBy(['id_aplicacion' => SORT_ASC])->one();
    
                if ($primeraAplicacion) {

                    // Encontrar todas las aplicaciones posteriores a la primera
                    $aplicacionesPosteriores = Aplicaciones::find()->where(['aplicacion' => $app->aplicacion])->andWhere(['id_portatil' => null])->andWhere(['>', 'id_aplicacion', $primeraAplicacion->id_aplicacion])->all();
    
                    // Borrar todas las aplicaciones posteriores
                    foreach ($aplicacionesPosteriores as $duplicada) {
                        $duplicada->delete();
                    }

                }

            }

        }

        $relaciones = Aplicaciones::find()->where(['not', ['id_portatil' => null]])->all();
        
        foreach ($relaciones as $relacion) {

            $existe = false;
    
            foreach ($aplicaciones as $app) {
                if ($relacion->aplicacion === $app->aplicacion) {
                    $existe = true;
                    break;
                }
            }

            if (!$existe) {
                $relacion->delete();
            }
    
        }

    }

}
