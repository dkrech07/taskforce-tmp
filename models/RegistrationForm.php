<?php

namespace app\models;

use yii\base\Model;
use app\models\Cities;
use app\models\Users;

class RegistrationForm extends Model
{
    public $name;
    public $email;
    public $city_id;
    public $password;
    public $password_repeat;
    public $role;

    public function rules()
    {
        return [
            [['name', 'email', 'password', 'password_repeat'], 'trim'],
            [['name', 'email', 'city_id', 'password', 'password_repeat'], 'required'],
            [['email'], 'string', 'max' => 128],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => Users::class],
            [['name'], 'string', 'length' => [2, 128]],
            [['password'], 'string', 'length' => [6, 128]],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password'],
            [['city_id'], 'integer'],
            [['city_id'], 'exist', 'targetClass' => Cities::class, 'targetAttribute' => 'id'],
            [['role'], 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'Email',
            'city_id' => 'Город',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'role' => 'Я собираюсь откликаться на заказы'
        ];
    }
}
