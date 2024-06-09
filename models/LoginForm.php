<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm es el modelo detrás del formulario de inicio de sesión.
 *
 * @property-read User|null $user
 */
class LoginForm extends Model {

    public $username;
    public $password;
    public $rememberMe = true;
    private $_user = false;

    /**
     * @return array las reglas de validación.
     */
    public function rules() {
        return [
            [['username', 'password'], 'required', 'message' => 'Campo obligatorio'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Etiquetas de los atributos
     * @return array las etiquetas de los atributos.
     */
    public function attributeLabels() {
        return [
            'username' => 'Nombre del usuario',
            'password' => 'Contraseña del usuario',
            'rememberMe' => 'Recuérdame',
        ];
    }

    /**
     * Valida la contraseña.
     * Este método sirve como validación en línea para la contraseña.
     *
     * @param string $attribute el atributo que se está validando actualmente
     * @param array $params los pares nombre-valor adicionales dados en la regla
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validateHash($this->password)) {
                $this->addError($attribute, 'Nombre de usuario o contraseña incorrectos.');
            }
        }
    }

    /**
     * Inicia sesión un usuario usando el nombre de usuario y la contraseña proporcionados.
     * @return bool si el usuario se ha registrado con éxito
     */
    public function login() {
        // Valida los datos de entrada y, si son correctos, inicia sesión al usuario
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0); // Duración de la sesión: 30 días si "Recuérdame" está marcado, 0 si no
        }
        return false;
    }

    /**
     * Encuentra un usuario por [[username]]
     *
     * @return User|null
     */
    public function getUser() {
        // Si no se ha cargado el usuario aún, lo busca por nombre de usuario
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }

}
