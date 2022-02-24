<?php

namespace app\services;

use Yii;
use app\models\Tasks;
use app\models\Replies;
use yii\db\Expression;
use TaskForce\utils\CustomHelpers;

class RepliesServices
{

    public function createReply($user_id, $id, Replies $repliesModel)
    {
        $reply = new Replies;
        $reply->dt_add = CustomHelpers::getCurrentDate();
        $reply->rate = $repliesModel->rate;
        $reply->description = $repliesModel->description;
        $reply->executor_id = Yii::$app->user->id;
        $reply->task_id = $id;
        $reply->executor_id = $user_id;
        // $reply->status = 1;
        // $reply->id = 111;

        print_r($reply);
        $reply->save();


        // $task->name = $addTaskFormModel->name;
        // $task->description = $addTaskFormModel->description;
        // $task->category_id = $addTaskFormModel->category_id;
        // $task->customer_id = Yii::$app->user->id;
        // $task->status = 'new';
        // $task->dt_add = CustomHelpers::getCurrentDate();
        // $task->deadline = $addTaskFormModel->deadline;

        // $task_id = $task->id;

        // foreach ($addTaskFormModel->files as $file) {
        //     $file_path = uniqid('file_') . '.' . $file->extension;
        //     $file->saveAs(Yii::getAlias('@webroot') . '/uploads/' . $file_path);

        //     $task_file = new TasksFiles;
        //     $task_file->link = $file_path;
        //     $task_file->task_id = $task_id;
        //     $task_file->save();
        // }

        // return $task_id;
    }
}
