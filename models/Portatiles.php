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
 * @property Cargan[] $cargans
 */
class Portatiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'portatiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'estado'], 'required'],
            [['memoria_ram', 'capacidad', 'id_almacen'], 'integer'],
            [['codigo'], 'string', 'max' => 4],
            [['marca', 'modelo', 'estado', 'procesador', 'dispositivo_almacenamiento'], 'string', 'max' => 24],
            [['codigo'], 'unique'],
            [['id_almacen'], 'exist', 'skipOnError' => true, 'targetClass' => Almacenes::class, 'targetAttribute' => ['id_almacen' => 'id_almacen']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_portatil' => 'Id Portatil',
            'codigo' => 'Codigo',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'estado' => 'Estado',
            'procesador' => 'Procesador',
            'memoria_ram' => 'Memoria Ram',
            'capacidad' => 'Capacidad',
            'dispositivo_almacenamiento' => 'Dispositivo Almacenamiento',
            'id_almacen' => 'Id Almacen',
        ];
    }

    /**
     * Gets query for [[Almacen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlmacen()
    {
        return $this->hasOne(Almacenes::class, ['id_almacen' => 'id_almacen']);
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumnos::class, ['id_portatil' => 'id_portatil']);
    }

    /**
     * Gets query for [[Aplicaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAplicaciones()
    {
        return $this->hasMany(Aplicaciones::class, ['id_portatil' => 'id_portatil']);
    }

    /**
     * Gets query for [[Cargadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargador()
    {
        return $this->hasMany(Cargadores::class, ['id_cargador' => 'id_cargador'])->viaTable('cargan', ['id_portatil' => 'id_portatil']);
    }

    /**
     * Gets query for [[Cargans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargan()
    {
        return $this->hasMany(Cargan::class, ['id_portatil' => 'id_portatil']);
    }

    public static function setEstado($codigo) {

        $horaInicioTurnoManana = '07:00:00';
        $horaFinTurnoManana = '15:00:00';
        $horaInicioTurnoTarde = '15:00:01';
        $horaFinTurnoTarde = '22:00:00';
    
        $trigger = <<< SQL
            CREATE TRIGGER `portatiles_bu` BEFORE UPDATE ON `portatiles`
            FOR EACH ROW BEGIN
    
            IF (
                SELECT COUNT(alumnos.id_alumno)
                FROM alumnos
                INNER JOIN cursan ON alumnos.id_alumno = cursan.id_alumno
                INNER JOIN cursos ON cursan.id_curso = cursos.id_curso
                INNER JOIN portatiles ON alumnos.id_portatil = portatiles.id_portatil
                WHERE cursos.turno = 'Mañana' AND portatiles.codigo = :codigo
            ) = 0 AND CURRENT_TIME() BETWEEN :horaInicioTurnoManana AND :horaFinTurnoManana AND portatiles.estado <> 'Averiado' THEN
                UPDATE portatiles SET estado = 'Disponible';
            ELSEIF (
                SELECT COUNT(alumnos.id_alumno)
                FROM alumnos
                INNER JOIN cursan ON alumnos.id_alumno = cursan.id_alumno
                INNER JOIN cursos ON cursan.id_curso = cursos.id_curso
                INNER JOIN portatiles ON alumnos.id_portatil = portatiles.id_portatil
                WHERE cursos.turno = 'Tarde' AND portatiles.codigo = :codigo
            ) = 0 AND CURRENT_TIME() BETWEEN :horaInicioTurnoTarde AND :horaFinTurnoTarde AND portatiles.estado <> 'Averiado' THEN
                UPDATE portatiles SET estado = 'Disponible' WHERE portatiles.codigo = :codigo;
            END IF;
    
            END;
        SQL;
    
        $this->execute('DROP TRIGGER /*!50032 IF EXISTS */ `estado_bu`');
    
        $this->execute($trigger, [
            ':codigo' => $codigo,
            ':horaInicioTurnoManana' => $horaInicioTurnoManana,
            ':horaFinTurnoManana' => $horaFinTurnoManana,
            ':horaInicioTurnoTarde' => $horaInicioTurnoTarde,
            ':horaFinTurnoTarde' => $horaFinTurnoTarde
        ]);

    }

}
