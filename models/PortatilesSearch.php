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
            'sort' => [
                'defaultOrder' => [
                    'codigo' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $searchTerms = explode(' ', $this->searchString);

        foreach ($searchTerms as $term) {
            $query->orFilterWhere(['like', 'codigo', $term])->orFilterWhere(['like', 'marca', $term])->orFilterWhere(['like', 'modelo', $term])->orFilterWhere(['like', 'estado', $this->searchString])->orFilterWhere(['like', 'procesador', $term])->orFilterWhere(['like', 'memoria_ram', $term])->orFilterWhere(['like', 'capacidad', $term])->orFilterWhere(['like', 'dispositivo_almacenamiento', $term]);
        }

        return $dataProvider;

    }

}
