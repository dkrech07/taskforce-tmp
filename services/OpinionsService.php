<?php

namespace app\services;

use Yii;
use app\models\Tasks;
use app\models\Opinions;
use app\models\Profiles;
use app\models\FinishedForm;

use TaskForce\utils\CustomHelpers;

class OpinionsService
{
    public function findUserTasksCount($userId)
    {
        // task = Tasks::find()->all();

        return Tasks::find()
            ->where(['executor_id' => $userId])
            ->count();
    }

    public function finishTask($id, FinishedForm $FinishedFormModel)
    {
        $task = Tasks::findOne(['id' => $id]);
        $profile = Profiles::findOne(['user_id' => $task->executor_id]);
        $opinions = new Opinions;

        $userTasksCount = Tasks::find()
            ->where(['executor_id' => $task->executor_id, 'status' => 'finished'])
            ->count();


        print($userTasksCount);
        $average_rating = ($profile->average_rating + $FinishedFormModel->rating) / ($userTasksCount + 1);
        $task->status = 'finished';
        $task->fin_date = CustomHelpers::getCurrentDate();;
        $profile->average_rating = floor($average_rating);
        $opinions->description = $FinishedFormModel->description;
        $opinions->rating = $FinishedFormModel->rating;
        $opinions->dt_add = CustomHelpers::getCurrentDate();
        $opinions->rate = $task->budget;
        $opinions->customer_id = $task->customer_id;
        $opinions->executor_id = $task->executor_id;
        $opinions->task_id = $id;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $task->save();
            $opinions->save();
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
