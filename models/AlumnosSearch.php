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
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->orFilterWhere(['like', 'dni', $this->searchString])->orFilterWhere(['like', 'nombre', $this->searchString])->orFilterWhere(['like', 'apellidos', $this->searchString])->orFilterWhere(['like', 'estado_matricula', $this->searchString]);

        return $dataProvider;

    }

}
