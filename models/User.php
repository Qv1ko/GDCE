<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface {

    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', // Contraseña cifrada SHA-512
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        // '101' => [
        //     'id' => '101',
        //     'username' => 'demo',
        //     'password' => 'demo',
        //     'authKey' => 'test101key',
        //     'accessToken' => '101-token',
        // ],
    ];

    /**
     * {@inheritdoc}
     * Busca la identidad de usuario por ID.
     * @param int $id ID del usuario.
     * @return static|null Retorna el usuario si lo encuentra, de lo contrario null.
     */
    public static function findIdentity($id) {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     * Busca la identidad de usuario por token de acceso.
     * @param string $token Token de acceso.
     * @param mixed $type Tipo del token.
     * @return static|null Retorna el usuario si lo encuentra, de lo contrario null.
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * Busca un usuario por su nombre de usuario.
     * @param string $username Nombre de usuario.
     * @return static|null Retorna el usuario si lo encuentra, de lo contrario null.
     */
    public static function findByUsername($username) {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     * Obtiene el ID del usuario.
     * @return int ID del usuario.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     * Obtiene la clave de autenticación del usuario.
     * @return string Clave de autenticación.
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     * Valida la clave de autenticación.
     * @param string $authKey Clave de autenticación a validar.
     * @return bool Retorna true si la clave es válida, de lo contrario false.
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Valida la contraseña del usuario.
     * @param string $password Contraseña a validar.
     * @return bool Retorna true si la contraseña es válida, de lo contrario false.
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

    /**
     * Valida el hash de la contraseña usando SHA-512.
     * @param string $hash Hash de la contraseña a validar.
     * @return bool Retorna true si el hash es válido, de lo contrario false.
     */
    public function validateHash($hash) {
        return hash_equals($this->password, hash('sha512', $hash));
    }

}
