<?php

namespace app\services;

use Yii;
use app\models\Profiles;
use app\models\Tasks;
use app\models\Specializations;
use app\models\Opinions;

use app\models\Users;
use app\models\RegistrationForm;

class UserService
{

    public function getExecutor($id)
    {
        return Profiles::find()
            ->joinWith('user', 'city')
            ->where(['profiles.id' => $id])
            ->one();
    }

    public function getExecutorTasksCount($id, $tasksStatus)
    {
        return Tasks::find()
            ->where(['executor_id' => $id, 'status' => $tasksStatus])
            ->count();
    }

    public function getExecutorSpecializations($id)
    {
        return Specializations::find()
            ->joinWith('specialization')
            ->where(['user_id' => $id])
            ->all();
    }

    public function getExecutorOpinions($id)
    {
        return Opinions::find()
            ->joinWith('task', 'profile')
            ->where(['opinions.executor_id' => $id])
            ->all();
    }

    public function getExecutorRatingPosition($id)
    {
        $usersRatings = Profiles::find()
            ->where(['role' => 1])
            ->orderBy('average_rating ASC')
            ->asArray()
            ->all();

        return array_search($id, array_column($usersRatings, 'id')) + 1;
    }

    public function SaveNewUserProfile(RegistrationForm $RegistrationModel): void
    {
        $profile = new Profiles();
        $user = new Users();

        $profile->city_id = $RegistrationModel->city_id;
        $profile->role = $RegistrationModel->role;

        $user->name = $RegistrationModel->name;
        $user->email = $RegistrationModel->email;
        $passwordHash = Yii::$app->getSecurity()->generatePasswordHash($RegistrationModel->password);
        $user->password = $passwordHash;
        $user->dt_add = date("Y.m.d H:i:s");

        $profile->save();
        $user->save();
    }
}
