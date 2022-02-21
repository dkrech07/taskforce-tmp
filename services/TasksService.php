<?php

namespace app\services;

use Yii;
use app\models\Tasks;
use app\models\Replies;
use app\models\AddTaskForm;
use app\models\TasksFiles;
use TaskForce\utils\CustomHelpers;

class TasksService
{

    public function getTask($id)
    {
        return Tasks::find()
            ->joinWith('city', 'category')
            ->where(['tasks.id' => $id])
            ->one();
    }

    public function getTaskFiles($id)
    {
        return TasksFiles::find()
            ->where(['task_id' => $id])
            ->all();
    }

    public function getReplies($id)
    {
        return Replies::find()
            ->joinWith('executor', 'opinion')
            ->where(['replies.task_id' => $id])
            ->all();
    }

    public function createTask(AddTaskForm $addTaskFormModel)
    {
        $task = new Tasks;

        $task->name = $addTaskFormModel->name;
        $task->description = $addTaskFormModel->description;
        $task->category_id = $addTaskFormModel->category_id;
        $task->customer_id = Yii::$app->user->id;
        $task->status = 'new';
        $task->dt_add = CustomHelpers::getCurrentDate();
        $task->deadline = $addTaskFormModel->deadline;

        $task->save();
        $task_id = $task->id;

        foreach ($addTaskFormModel->files as $file) {
            $file_path = uniqid('file_') . '.' . $file->extension;
            $file->saveAs(Yii::getAlias('@webroot') . '/uploads/' . $file_path);

            $task_file = new TasksFiles;
            $task_file->link = $file_path;
            $task_file->task_id = $task_id;
            $task_file->save();
        }

        return $task_id;
    }
}
