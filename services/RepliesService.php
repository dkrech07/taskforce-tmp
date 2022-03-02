<?php

namespace app\services;

use Yii;
use app\models\Tasks;
use app\models\Replies;
use app\models\ResponseForm;
use app\models\Profiles;
use app\models\RefuseForm;

use TaskForce\utils\CustomHelpers;

class RepliesService
{

    public function createReply($user_id, $id, ResponseForm $responseFormModel)
    {
        $reply = new Replies;
        $reply->dt_add = CustomHelpers::getCurrentDate();
        $reply->rate = $responseFormModel->rate;
        $reply->description = $responseFormModel->description;
        $reply->executor_id = Yii::$app->user->id;
        $reply->task_id = $id;
        $reply->executor_id = $user_id;
        $reply->save();
    }

    public function AcceptReply($id)
    {
        $reply = Replies::findOne(['id' => $id]);
        $task = Tasks::findOne(['id' => $reply->task_id]);
        $reply->status = 1;
        $task->executor_id = $reply->executor_id;
        $task->budget = $reply->rate;
        $task->status = 'in_progress';

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $reply->save();
            $task->save();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
        }

        return $reply;
    }

    public function RefuseTask($user_id, $id, RefuseForm $refuseFormModel)
    {
        $reply = Replies::findOne(['task_id' => $id, 'executor_id' => $user_id]);
        $task = Tasks::findOne(['id' => $id]);
        $profile = Profiles::findOne(['user_id' => $user_id]);


        $reply->description = $refuseFormModel->description;
        $reply->dt_add = CustomHelpers::getCurrentDate();
        $task->status = 'finished';
        $profile->filed_tasks = $profile->filed_tasks + 1;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $reply->save();
            $task->save();
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
