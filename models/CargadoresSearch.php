<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cargadores;

class CargadoresSearch extends Cargadores {

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

        $query = Cargadores::find();

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
            $query->orFilterWhere(['like', 'codigo', $term])->orFilterWhere(['like', 'potencia', $term])->orFilterWhere(['like', 'estado', $this->searchString]);
        }

        return $dataProvider;

    }

}
