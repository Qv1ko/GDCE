<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Almacenes;

class AlmacenesSearch extends Almacenes {

    public $searchString;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['searchString'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        return Model::scenarios();
    }

    /**
     * Realiza una búsqueda de almacenes.
     * @param array $params Parámetros de búsqueda.
     * @return ActiveDataProvider Resultados de la búsqueda.
     */
    public function search($params) {

        $query = Almacenes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 24
            ],
            'sort' => [
                'defaultOrder' => [
                    'aula' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $searchTerms = explode(' ', $this->searchString);

        foreach ($searchTerms as $term) {
            $query->orFilterWhere(['like', 'aula', $term])->orFilterWhere(['like', 'capacidad', $term]);
        }

        return $dataProvider;

    }

}
