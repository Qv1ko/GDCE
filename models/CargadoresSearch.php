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

        // Carga los parámetros de búsqueda en el modelo actual
        $this->load($params);

        // Si la validación de los parámetros falla, retorna el proveedor de datos sin aplicar filtros adicionales
        if (!$this->validate()) {
            return $dataProvider;
        }

        // Divide la cadena de búsqueda
        $searchTerms = explode(' ', $this->searchString);

        foreach ($searchTerms as $term) {
            $query->orFilterWhere(['like', 'codigo', $term])->orFilterWhere(['like', 'potencia', $term])->orFilterWhere(['like', 'estado', $this->searchString]);
        }

        // Retorna el proveedor de datos con los filtros aplicados
        return $dataProvider;

    }

}
