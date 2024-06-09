<?php

namespace app\models;

use app\models\Almacenes;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AlmacenesSearch extends Almacenes {

    // Cadena de búsqueda
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

        // Carga los parámetros en el modelo y valida
        $this->load($params);

        // Si la validación falla, devuelve el dataProvider sin filtrar
        if (!$this->validate()) {
            return $dataProvider;
        }

        // Divide la cadena de búsqueda
        $searchTerms = explode(' ', $this->searchString);

        // Añade condiciones de filtro
        foreach ($searchTerms as $term) {
            $query->orFilterWhere(['like', 'aula', $term])->orFilterWhere(['like', 'capacidad', $term]);
        }

        // Devuelve los resultados de la búsqueda
        return $dataProvider;

    }

}
