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
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->orFilterWhere(['like', 'codigo', $this->searchString])->orFilterWhere(['like', 'potencia', $this->searchString])->orFilterWhere(['like', 'estado', $this->searchString]);

        return $dataProvider;

    }

}
