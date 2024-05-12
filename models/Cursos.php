<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cursos".
 *
 * @property int $id_curso
 * @property string $nombre
 * @property string|null $nombre_corto
 * @property string $curso
 * @property string $turno
 * @property string $aula
 * @property string $tutor
 *
 * @property Alumnos[] $alumnos
 * @property Cursan[] $cursans
 */
class Cursos extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'cursos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nombre', 'curso', 'turno', 'aula', 'tutor'], 'required', 'message' => '⚠️ Este campo es obligatorio'],
            [['nombre'], 'string', 'max' => 96],
            [['nombre'], 'match', 'pattern' => '/^[a-zA-ZÁÉÍÓÚÑáéíóúñ ]+$/', 'message' => '⚠️ El nombre solo puede contener caracteres alfabéticos'],
            [['nombre_corto', 'turno'], 'string', 'max' => 8],
            [['nombre_corto'], 'match', 'pattern' => '/^[A-Z]+$/', 'message' => '⚠️ La sigla solo puede contener caracteres alfabéticos en mayúscula'],
            [['curso'], 'string', 'max' => 16],
            [['curso'], 'in', 'range' => ['Primer curso', 'Segundo curso'], 'message' => '⚠️ El curso solo puede ser "Primer curso" o "Segundo curso"'],
            [['turno'], 'string', 'max' => 8],
            [['turno'], 'in', 'range' => ['Mañana', 'Tarde'], 'message' => '⚠️ El turno solo puede ser "Mañana" o "Tarde"'],
            [['aula'], 'string', 'max' => 4],
            [['aula'], 'match', 'pattern' => '/^\d{3}[A-Z]$/', 'message' => '⚠️ El aula debe seguir el siguiente formato de ejemplo: "123N"'],
            [['tutor'], 'string', 'max' => 24],
            [['tutor'], 'match', 'pattern' => '/^[a-zA-ZÁÉÍÓÚÑáéíóúñ ]+$/', 'message' => '⚠️ El nombre del tutor solo puede contener caracteres alfabéticos'],
            [['nombre', 'curso'], 'unique', 'targetAttribute' => ['nombre', 'curso'], 'message' => '⚠️ El curso ya existe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_curso' => 'ID del curso',
            'nombre' => 'Nombre del curso',
            'nombre_corto' => 'Sigla',
            'curso' => 'Curso: Primer curso / Segundo curso',
            'turno' => 'Turno',
            'aula' => 'Aula',
            'tutor' => 'Nombre del tutor',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos() {
        return $this->hasMany(Alumnos::class, ['id_alumno' => 'id_alumno'])->viaTable('cursan', ['id_curso' => 'id_curso']);
    }

    /**
     * Gets query for [[Cursans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursans() {
        return $this->hasMany(Cursan::class, ['id_curso' => 'id_curso']);
    }

    public function beforeSave($insert) {

        if (parent::beforeSave($insert)) {

            $sigla = '';

            foreach (str_split($this->nombre) as $letra) {
                if (ctype_upper($letra)) {
                    $sigla .= $letra;
                }
            }

            $this->nombre_corto = $sigla;
            
            return true;

        }

        return false;

    }

}
