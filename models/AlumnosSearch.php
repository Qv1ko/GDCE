<?php

namespace app\models;

use app\models\Alumnos;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AlumnosSearch extends Alumnos {

    // Cadena de búsqueda
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
            $query->orFilterWhere(['like', 'dni', $term])->orFilterWhere(['like', 'nombre', $term])->orFilterWhere(['like', 'apellidos', $term])->orFilterWhere(['like', 'CONCAT(nombre, " ", apellidos)', $term])->orFilterWhere(['like', 'estado_matricula', $this->searchString]);
        }

        // Devuelve los resultados de la búsqueda
        return $dataProvider;

    }

}
