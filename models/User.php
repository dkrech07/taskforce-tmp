<?php

namespace app\models;

use yii\web\IdentityInterface;

class User extends Users implements IdentityInterface // Отнаследовался от Users, чтобы при авторизации "стучаться" в таблицу с пользователями, сохраняя все методы авторизации отдельно от модели Users;
{
    public $password_repeat;

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
}
