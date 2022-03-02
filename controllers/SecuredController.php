<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use TaskForce\utils\CustomHelpers;

abstract class SecuredController extends Controller
{
    // Применяет правила авторизации к контроллерам;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    // Редиректит на лендинг, если не авторизован;
    // Редиректит в задачи, если пользователь не является постановщиком;
    public function beforeAction($action)
    {
        if (CustomHelpers::checkAuthorization() === null) {
            $this->redirect('/landing');
            return false;
        }

        if ($action->id === 'add') {
            if (\Yii::$app->user->identity->role !== 0) {
                $this->redirect('/tasks/index');
                return false;
            }
        }

        return true;
    }
}
