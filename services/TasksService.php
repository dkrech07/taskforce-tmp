<?php

namespace app\services;

use Yii;
use app\models\Tasks;
use app\models\Replies;
use app\models\AddTaskForm;

class TasksService
{
    public function getTask($id)
    {
        return Tasks::find()
            ->joinWith('city', 'category')
            ->where(['tasks.id' => $id])
            ->one();
    }

    public function getReplies($id)
    {
        return Replies::find()
            ->joinWith('executor', 'opinion')
            ->where(['replies.task_id' => $id])
            ->all();
    }

    public function createTask(AddTaskForm $model): int
    {
        $task = new Tasks;

        $task->attributes = $model->attributes;
        $task->status = 'new';
        $task->customer_id = Yii::$app->user->id;

        $task->save();
        // $this->upload($model, $task->id);

        return $task->id;
    }
}
