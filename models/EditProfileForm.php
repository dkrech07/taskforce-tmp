<?php

namespace app\models;

use yii\base\Model;
use app\models\Categories;
use app\models\User;
use app\models\Users;
use app\models\Profiles;


class ProfileForm extends Model
{
    public $avatar_link;
    public $name;
    public $email;
    public $bd;
    public $phone;
    public $messanger;
    public $about;
    public $categories;

    // /**
    //  * @param User $user
    //  * @return void
    //  */
    // public function loadCurrentValues(User $user): void
    // {
    //     $this->attributes = array_merge(
    //         $user->attributes,
    //         $user->profile->attributes,
    //         ['categories' => array_column($user->categories, 'id')],
    //     );
    // }

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['avatar_link'], 'string', 'max' => 128],
            [['name'], 'string', 'length' => [2, 128]],
            [['email', 'about'], 'string', 'max' => 128],
            [['email'], 'email'],
            [
                ['bd'], 'date', 'format' => 'php:Y-m-d', 'max' => strtotime('today'),
                'tooBig' => 'Дата не может быть позже текущего дня'
            ],
            [['about', 'bd', 'phone', 'messanger'], 'default', 'value' => null],
            [['phone'], 'string', 'length' => [11, 11]],
            [['messanger'], 'string', 'max' => 64],
            [['categories'], 'default', 'value' => []],
            [['categories'], 'exist', 'targetClass' => Categories::class, 'targetAttribute' => 'id', 'allowArray' => true]
        ];
    }

    public function attributeLabels()
    {
        return [
            'avatar_link' => 'Сменить аватар',
            'name' => 'Ваше имя',
            'email' => 'Email',
            'bd' => 'День рождения',
            'phone' => 'Номер телефона',
            'messanger' => 'Telegram',
            'about' => 'Информация о себе',
            'categories' => 'Выбор специализаций'
        ];
    }
}
