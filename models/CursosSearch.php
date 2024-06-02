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
            'sort' => [
                'defaultOrder' => [
                    'nombre' => SORT_ASC,
                    'curso' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $searchTerms = explode(' ', $this->searchString);

        foreach ($searchTerms as $term) {
            $query->orFilterWhere(['like', 'nombre', $this->searchString])->orFilterWhere(['like', 'sigla', $term])->orFilterWhere(['like', 'curso', $this->searchString])->orFilterWhere(['like', 'turno', $term])->orFilterWhere(['like', 'aula', $term])->orFilterWhere(['like', 'tutor', $this->searchString]);
        }

        return $dataProvider;

    }

}
