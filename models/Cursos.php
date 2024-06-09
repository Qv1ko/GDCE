<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Esta es la clase modelo para la tabla "cursos".
 *
 * @property int $id_curso
 * @property string $nombre
 * @property string|null $sigla
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
            [['nombre', 'curso', 'turno', 'aula', 'tutor'], 'required', 'message' => '⚠️ Campo obligatorio'],
            [['nombre'], 'string', 'max' => 96],
            [['nombre'], 'match', 'pattern' => '/^[a-zA-ZÁÉÍÓÚÑáéíóúñ ]+$/', 'message' => '⚠️ Solo puede contener caracteres alfabéticos'],
            [['nombre'], 'match', 'pattern' => '/[A-ZÁÉÍÓÚÑ]/', 'message' => '⚠️ La primera letra de cada palabra tiene que ser mayúscula'],
            [['sigla', 'turno'], 'string', 'max' => 8],
            [['sigla'], 'match', 'pattern' => '/^[A-Z]+$/', 'message' => '⚠️ Solo puede contener caracteres alfabéticos en mayúscula'],
            [['curso'], 'string', 'max' => 16],
            [['curso'], 'in', 'range' => ['Primer curso', 'Segundo curso'], 'message' => '⚠️ Solo puede ser "Primer curso" o "Segundo curso"'],
            [['turno'], 'string', 'max' => 8],
            [['turno'], 'in', 'range' => ['Mañana', 'Tarde'], 'message' => '⚠️ Solo puede ser "Mañana" o "Tarde"'],
            [['aula'], 'string', 'max' => 4],
            [['aula'], 'match', 'pattern' => '/^\d{3}[A-Z]$/', 'message' => '⚠️ Formato incorrecto'],
            [['tutor'], 'string', 'max' => 24],
            [['tutor'], 'match', 'pattern' => '/^[a-zA-ZÁÉÍÓÚÑáéíóúñ ]+$/', 'message' => '⚠️ Solo puede contener caracteres alfabéticos'],
            [['nombre', 'curso'], 'unique', 'targetAttribute' => ['nombre', 'curso'], 'message' => '⚠️ Ya existe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_curso' => 'ID del curso',
            'nombre' => 'Nombre del curso',
            'sigla' => 'Sigla',
            'curso' => 'Curso',
            'turno' => 'Turno',
            'aula' => 'Aula',
            'tutor' => 'Nombre del tutor',
        ];
    }

    /**
     * Obtiene la consulta para [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos() {
        return $this->hasMany(Alumnos::class, ['id_alumno' => 'id_alumno'])->viaTable('cursan', ['id_curso' => 'id_curso']);
    }

    /**
     * Obtiene la consulta para [[Cursans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursan() {
        return $this->hasMany(Cursan::class, ['id_curso' => 'id_curso']);
    }

    /**
     * Obtiene una lista de cursos en turno de mañana.
     *
     * @return array Lista de cursos en turno de mañana.
     */
    public static function getListaCursosManana() {
        $lista = ArrayHelper::map(Cursos::find()->where(['turno' => 'Mañana'])->all(), 'id_curso', function($model) {
            return (($model->curso == 'Primer curso') ? '1º ' : '2º ') . $model->nombre;
        });
        asort($lista);
        return $lista;
    }

    /**
     * Obtiene una lista de cursos en turno de tarde.
     *
     * @return array Lista de cursos en turno de tarde.
     */
    public static function getListaCursosTarde() {
        $lista = ArrayHelper::map(Cursos::find()->where(['turno' => 'Tarde'])->all(), 'id_curso', function($model) {
            return (($model->curso == 'Primer curso') ? '1º ' : '2º ') . $model->nombre;
        });
        asort($lista);
        return $lista;
    }

    /**
     * Genera la sigla del curso a partir de su nombre.
     *
     * @param object $model El modelo de curso.
     */
    public static function setSigla($model) {

        $nombreCurso = $model->nombre;
        $nombreCurso = str_replace(['Á', 'á', 'É', 'é', 'Í', 'í', 'Ó', 'ó', 'Ú', 'ú', 'Ñ'], ['A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u', 'N'], $nombreCurso);
        $sigla = '';

        // Extrae las letras mayúsculas para formar la sigla
        foreach (str_split($nombreCurso) as $letra) {
            if (ctype_upper($letra)) {
                $sigla .= $letra;
            }
        }

        // Limita la sigla a 8 caracteres y la guarda en el modelo
        $model->sigla = substr($sigla, 0, 8);
        $model->save();

    }

}
