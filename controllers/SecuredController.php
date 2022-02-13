<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use TaskForce\utils\CustomHelpers;

abstract class SecuredController extends Controller
{
    // Применяет правила авторизации к контроллерам;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false,
                        'roles' => ['?'],
                        'denyCallback' => function ($rule, $action) {
                            throw new HttpException(401, "Вы не авторизованы!");
                        }
                    ]
                ]
            ]
        ];
    }

    // Редиректит на лендинг, если не авторизован;
    public function beforeAction($action)
    {
        if (CustomHelpers::checkAuthorization() === null) {
            $this->redirect('/landing');
            return false;
        }
        return true;
    }
}
