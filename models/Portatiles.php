<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "portatiles".
 *
 * @property int $id_portatil
 * @property string $codigo
 * @property string|null $marca
 * @property string|null $modelo
 * @property string $estado
 * @property string|null $procesador
 * @property int|null $memoria_ram
 * @property int|null $capacidad
 * @property string|null $dispositivo_almacenamiento
 * @property int|null $id_almacen
 *
 * @property Almacenes $almacen
 * @property Alumnos[] $alumnos
 * @property Aplicaciones[] $aplicaciones
 * @property Cargadores[] $cargadors
 * @property Cargan[] $Cargan
 */
class Portatiles extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'portatiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['codigo', 'estado'], 'required', 'message' => '⚠️ Campo es obligatorio'],
            [['memoria_ram', 'capacidad', 'id_almacen'], 'integer', 'message' => '⚠️ Formato incorrecto (ej: 8)'],
            [['codigo'], 'string', 'max' => 4],
            [['codigo'], 'match', 'pattern' => '/^\d{3}[A-Z]$/', 'message' => '⚠️ Formato incorrecto (ej: 001A)'],
            [['marca', 'modelo', 'estado', 'procesador', 'dispositivo_almacenamiento'], 'string', 'max' => 24],
            [['marca'], 'match', 'pattern' => '/^[a-zA-ZÁÉÍÓÚÑáéíóúñ ]+$/', 'message' => '⚠️ Solo puede contener caracteres alfabéticos'],
            [['estado'], 'in', 'range' => ['Disponible', 'No disponible', 'Averiado'], 'message' => '⚠️ Solo puede ser "Disponible", "No disponible" o "Averiado"'],
            [['dispositivo_almacenamiento'], 'in', 'range' => ['HDD', 'SSD'], 'message' => '⚠️ Solo puede ser "HDD" o "SSD"'],
            [['codigo'], 'unique', 'message' => '⚠️ El portátil ya existe'],
            [['id_almacen'], 'exist', 'skipOnError' => true, 'targetClass' => Almacenes::class, 'targetAttribute' => ['id_almacen' => 'id_almacen']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_portatil' => 'Portátil',
            'codigo' => 'Código',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'estado' => 'Estado',
            'procesador' => 'Procesador',
            'memoria_ram' => 'Gigabytes de memoria RAM',
            'capacidad' => 'Gigabytes de capacidad',
            'dispositivo_almacenamiento' => 'Dispositivo de almacenamiento',
            'id_almacen' => 'Almacén',
        ];
    }

    /**
     * Gets query for [[Almacen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlmacen() {
        return $this->hasOne(Almacenes::class, ['id_almacen' => 'id_almacen']);
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos() {
        return $this->hasMany(Alumnos::class, ['id_portatil' => 'id_portatil']);
    }

    /**
     * Gets query for [[Aplicaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAplicaciones() {
        return $this->hasMany(Aplicaciones::class, ['id_portatil' => 'id_portatil']);
    }

    /**
     * Gets query for [[Cargadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargador() {
        return $this->hasOne(Cargadores::class, ['id_cargador' => 'id_cargador'])->viaTable('cargan', ['id_portatil' => 'id_portatil']);
    }

    /**
     * Gets query for [[Cargan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargan() {
        return $this->hasOne(Cargan::class, ['id_portatil' => 'id_portatil']);
    }

    public static function sincronizarPortatiles() {

        $portatiles = Portatiles::find()->all();
        $hora = date('H:i:s');
        $horaInicioTurnoManana = '07:00:00';
        $horaFinTurnoManana = '15:00:00';
        $horaInicioTurnoTarde = '15:00:01';
        $horaFinTurnoTarde = '22:00:00';

        foreach ($portatiles as $portatil) {

            $alumnoManana = Portatiles::find()->select('alumno')->innerJoin(['am' => Alumnos::getAlumnosManana()], 'am.id_portatil = portatiles.id_portatil')->where(['codigo' => $portatil->codigo])->one();
            $alumnoTarde = Portatiles::find()->select('alumno')->innerJoin(['at' => Alumnos::getAlumnosTarde()], 'at.id_portatil = portatiles.id_portatil')->where(['codigo' => $portatil->codigo])->one();

            if ($portatil->estado !== 'Averiado') {
                if ($hora >= $horaInicioTurnoManana && $hora <= $horaFinTurnoManana) {
                    $portatil->estado = ($alumnoManana !== null) ? 'No disponible' : 'Disponible';
                } elseif ($hora >= $horaInicioTurnoTarde && $hora <= $horaFinTurnoTarde) {
                    $portatil->estado = ($alumnoTarde !== null) ? 'No disponible' : 'Disponible';
                } else {
                    ($alumnoManana !== null && $alumnoTarde !== null) ? 'No disponible' : 'Disponible';
                }
                $portatil->save();
            }

        }

    }

    public static function sincronizarPortatil($codigo) {

        $portatil = Portatiles::find()->where(['codigo' => $codigo])->one();

        $hora = date('H:i:s');
        $horaInicioTurnoManana = '07:00:00';
        $horaFinTurnoManana = '15:00:00';
        $horaInicioTurnoTarde = '15:00:01';
        $horaFinTurnoTarde = '22:00:00';
    
        $alumnoManana = Portatiles::find()->select('alumno')->innerJoin(['am' => Alumnos::getAlumnosManana()], 'am.id_portatil = portatiles.id_portatil')->where(['codigo' => $codigo])->one();
        $alumnoTarde = Portatiles::find()->select('alumno')->innerJoin(['at' => Alumnos::getAlumnosTarde()], 'at.id_portatil = portatiles.id_portatil')->where(['codigo' => $codigo])->one();

        if ($portatil !== null && $portatil->estado !== 'Averiado') {
            if ($hora >= $horaInicioTurnoManana && $hora <= $horaFinTurnoManana) {
                $portatil->estado = ($alumnoManana !== null) ? 'No disponible' : 'Disponible';
            } elseif ($hora >= $horaInicioTurnoTarde && $hora <= $horaFinTurnoTarde) {
                $portatil->estado = ($alumnoTarde !== null) ? 'No disponible' : 'Disponible';
            } else {
                ($alumnoManana !== null && $alumnoTarde !== null) ? 'No disponible' : 'Disponible';
            }
            $portatil->save();
        }

    }

}
