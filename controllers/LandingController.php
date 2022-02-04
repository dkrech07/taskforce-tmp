<?php

namespace app\controllers;

use Yii;
use app\models\Tasks;
use app\models\LoginForm;
use yii\web\Controller;

class LandingController extends Controller
{
    public $layout = 'landing';

    // Отрисовка страницы авторизации, вывод формы авторизации;
    public function actionIndex()
    {
        $loginForm = new LoginForm();
        return $this->render('index', ['loginForm' => $loginForm]);
    }

    public function actionLogin()
    {
        $loginForm = new LoginForm();
        if (\Yii::$app->request->getIsPost()) {
            $loginForm->load(\Yii::$app->request->post());
            if ($loginForm->validate()) {
                $user = $loginForm->getUser();
                \Yii::$app->user->login($user);
                return $this->goHome();
            }
        }
    }
}

// class LandingController extends \yii\web\Controller
// {

//     // Вход на сайт
//     // public function actionLogin()
//     // {
//     //     $loginForm = new LoginForm();
//     //     if (\Yii::$app->request->getIsPost()) {
//     //         $loginForm->load(\Yii::$app->request->post());
//     //         if ($loginForm->validate()) {
//     //             $user = $loginForm->getUser();
//     //             \Yii::$app->user->login($user);
//     //             return $this->goHome();
//     //         }
//     //     }
//     // }


//     public $layout = 'landing';

//     // public function beforeAction($action)
//     // {
//     //     parent::beforeAction($action);
//     //     if (Yii::$app->user->getId()) {
//     //         $this->redirect('/tasks/index');
//     //     }
//     //     return true;
//     // }

//     // Отрисовка страницы авторизации, вывод формы авторизации;
//     public function actionIndex()
//     {
//         // $loginForm = [];
//         // $tasks = Tasks::getLastTasks(4);

//         $loginForm = new LoginForm();

//         return $this->render('index', ['loginForm' => $loginForm]);
//     }

//     // Вход на сайт, переход на страницу задач;
//     public function actionLogin()
//     {
//         $loginForm = new LoginForm();
//         if (\Yii::$app->request->getIsPost()) {
//             $loginForm->load(\Yii::$app->request->post());
//             if ($loginForm->validate()) {
//                 $user = $loginForm->getUser();
//                 \Yii::$app->user->login($user);
//                 // return $this->goHome();

//                 $this->redirect('landing');
//             }
//         }
//     }
// }
