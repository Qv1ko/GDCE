<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cursos;

class CursosSearch extends Cursos {

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

        $query = Cursos::find();

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

        $query->orFilterWhere(['like', 'nombre', $this->searchString])->orFilterWhere(['like', 'sigla', $this->searchString])->orFilterWhere(['like', 'curso', $this->searchString])->orFilterWhere(['like', 'turno', $this->searchString])->orFilterWhere(['like', 'aula', $this->searchString])->orFilterWhere(['like', 'tutor', $this->searchString]);

        return $dataProvider;

    }

}
