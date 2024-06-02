<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Alumnos;

class AlumnosSearch extends Alumnos {

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

        $query = Alumnos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 24
            ],
            'sort' => [
                'defaultOrder' => [
                    'apellidos' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $searchTerms = explode(' ', $this->searchString);

        foreach ($searchTerms as $term) {
            $query->orFilterWhere(['like', 'dni', $term])->orFilterWhere(['like', 'nombre', $term])->orFilterWhere(['like', 'apellidos', $term])->orFilterWhere(['like', 'CONCAT(nombre, " ", apellidos)', $term])->orFilterWhere(['like', 'estado_matricula', $this->searchString]);
        }

        return $dataProvider;

    }

}
