<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use TaskForce\utils\CustomHelpers;
use app\models\Tasks;


class MytasksController extends SecuredController
{

    public function actionIndex()
    {

        $tasks = Tasks::find()->all(); // Получаю все доступные задачи (пока что так);

        return $this->render('index', [
            'tasks' => $tasks,
        ]);
    }
}
