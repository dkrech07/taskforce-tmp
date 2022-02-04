<?php

namespace app\controllers;

use app\models\Profiles;

class ProfilesController
{
    public function __construct($profile_id)
    {
        $this->profile_id = $profile_id;
    }

    public function actionIndex()
    {
        $profile = Profiles::findOne(['id' => "$this->profile_id"]);
        if ($profile) {
            print("Произвольная запись таблицы 'Профили:'" . '<br>');
            print($profile->id . '<br>');
            print($profile->address . '<br>');
            print($profile->bd . '<br>');
            print($profile->about . '<br>');
            print($profile->phone . '<br>');
            print($profile->skype . '<br>');
            print($profile->city_id . '<br>');
        }
    }
}
