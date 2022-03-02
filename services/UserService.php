<?php

namespace app\services;

use Yii;
use app\models\Profiles;
use app\models\Tasks;
use app\models\Specializations;
use app\models\Opinions;
use app\models\Users;
use app\models\RegistrationForm;
use TaskForce\utils\CustomHelpers;

class UserService
{

    public function getExecutor($id)
    {
        return Users::find()
            ->joinWith('profile', 'city')
            ->where(['users.id' => $id])
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
        $usersRatings = Users::find()
            ->where(['role' => 1])
            ->joinWith('profile')
            ->orderBy('average_rating ASC')
            ->asArray()
            ->all();

        return array_search($id, array_column($usersRatings, 'id')) + 1;
    }

    public function SaveNewUserProfile(RegistrationForm $RegistrationModel): void
    {
        $user = new Users();
        $profile = new Profiles();

        $user->city_id = $RegistrationModel->city_id;
        $user->role = $RegistrationModel->role;
        $user->name = $RegistrationModel->name;
        $user->email = $RegistrationModel->email;
        $passwordHash = Yii::$app->getSecurity()->generatePasswordHash($RegistrationModel->password);
        $user->password = $passwordHash;
        $user->dt_add = CustomHelpers::getCurrentDate(); //date("Y.m.d H:i:s");

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $user->save();
            $profile->user_id = $user->id;
            $profile->avatar_link = '/img/avatars/' . random_int(1, 5) . '.png';
            $profile->average_rating = 0;
            $profile->save();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
        }
    }
}
