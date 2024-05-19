<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Portatiles;

class PortatilesSearch extends Portatiles {

    public $searchString;

    public function rules() {
        return [
            [['searchString'], 'safe'],
        ];
    }

    public function scenarios() {
        return Model::scenarios();
    }

    public function search($params) {

        $query = Portatiles::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 24
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->orFilterWhere(['like', 'codigo', $this->searchString])->orFilterWhere(['like', 'marca', $this->searchString])->orFilterWhere(['like', 'modelo', $this->searchString])->orFilterWhere(['like', 'estado', $this->searchString])->orFilterWhere(['like', 'procesador', $this->searchString])->orFilterWhere(['like', 'memoria_ram', $this->searchString])->orFilterWhere(['like', 'capacidad', $this->searchString])->orFilterWhere(['like', 'dispositivo_almacenamiento', $this->searchString]);

        return $dataProvider;

    }

}
