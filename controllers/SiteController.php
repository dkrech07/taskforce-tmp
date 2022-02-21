<?php

namespace app\controllers;

use Yii;
use app\models\RegistrationForm;
use app\models\Cities;
use app\services\UserService;
use yii\web\Controller;
use TaskForce\utils\CustomHelpers;
use yii\filters\AccessControl;

class SiteController extends Controller
{
    // Применяет правила авторизации к контроллерам;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['registration'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['registration'],
                        'matchCallback' => function ($rule, $action) {
                            return CustomHelpers::checkAuthorization() === null;
                        }
                    ]
                ]
            ]
        ];
    }


    public function actionRegistration()
    {
        $RegistrationModel = new RegistrationForm();

        $cities = Cities::find()
            ->select(['id', 'city'])
            ->indexBy('id')
            ->asArray()
            ->all();

        if (Yii::$app->request->getIsPost()) {
            $RegistrationModel->load(Yii::$app->request->post());

            if ($RegistrationModel->validate()) {
                (new UserService())->SaveNewUserProfile($RegistrationModel);

                $user = $RegistrationModel->getUser(); // Если валидация прошла, то получим модель найденного пользователя из формы;
                Yii::$app->user->login($user); //Вызываем логин пользователя средствами встроенного компонента User;
                $this->redirect('/tasks/index');
            }
        }

        return $this->render('registration', [
            'model' => $RegistrationModel,
            'cities' => $cities,
        ]);
    }

    // Разлогинивает пользователя;
    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->goHome();
    }

    // Редиректит в задачи со страницы регистрации, если уже авторизован;
    public function beforeAction($action)
    {
        if ($action->id === 'registration') {
            if (CustomHelpers::checkAuthorization() !== null) {
                $this->redirect('/tasks/index');
                return false;
            }
        }
        return true;
    }
}
