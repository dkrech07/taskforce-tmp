<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use TaskForce\utils\CustomHelpers;
use app\models\Tasks;


class MytasksController extends Controller
{
    static function getTasksStatus($tasks_status)
    {

        if (isset($tasks_status)) {
            return Tasks::find()
                ->where(['tasks.status' => $tasks_status])
                ->all();
        }
        return Tasks::find()->all();
    }

    public function actionIndex($tasks_status = 'new')
    {

        $myTasks = self::getTasksStatus($tasks_status);

        $tasks = Tasks::find()->all(); // Получаю все доступные задачи (пока что так);

        return $this->render('index', [
            'tasks' => $tasks,
            'tasks_status' => $tasks_status,
            'myTasks' => $myTasks,
        ]);
    }
}
