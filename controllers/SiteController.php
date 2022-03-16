<?php

namespace app\controllers;

use Yii;
use app\models\RegistrationForm;
use app\models\Cities;
use app\models\Users;
use app\services\UserService;
use app\services\AuthService;
use yii\web\Controller;
use TaskForce\utils\CustomHelpers;
use yii\filters\AccessControl;
use yii\authclient\ClientInterface;
use app\components\AuthHandler;
use yii\helpers\ArrayHelper;


class SiteController extends Controller
{
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function onAuthSuccess($client)
    {

        $attributes = $client->getUserAttributes(); // Данные пользователя;
        $sourceId = ArrayHelper::getValue($attributes, 'id'); // id пользователя
        $source = $client->getId(); // id клиента (vkontakte)

        // Если пользователь найден по id и source ID  в таблице Auth, авторизовать его по данным из Auth;
        $auth = (new AuthService())->findOne($source, $sourceId);
        if (isset($auth)) {
            Yii::$app->user->login($auth->user); //Вызываем логин пользователя средствами встроенного компонента User;
            print_r($auth->user);
            exit;
        }

        // Условие: Если пользователь ранее не регистрировался через Вконтатке;
        $email = ArrayHelper::getValue($attributes, 'email');
        // Запрашиваем email пользователя из Вконтакте и проверяем есть ли он (указывал ли его пользователь в Вк);
        if (isset($email)) {

            // Условие: Но его email из Вконтакте совпадает с email в таблице Users;
            // Добавляем в таблицу Auth запись, ссылающующся на таблицу Users;
            $user = (new UserService())->findByEmail($email); // Ищем пользователя по email из Вк;
            if ($user) {
                (new AuthService())->create($user->id, $source, $sourceId);
                // (new UserService())->login($email);
                // Yii::$app->user->login($email); - временно закомментировал
                // Условие: И его email из Вконтакте не совпадает с email  в таблице Users;
                // Регистрируем нового пользователя: зоздаем новую запись в таблице Auth и Users;
            } elseif ((new UserService())->signupVKUser($attributes, $source)) {
                // Yii::$app->user->login($email); - временно закомментировал
            }
        }

        // print_r($attributes);
        // print('<br>');
        // print_r($sourceId);
        // print('<br>');
        // print_r($source);
        // print('<br>');
        // print_r($email);
        // print('<br>');
        // exit;

        // if ($auth = (new AuthService())->findOne($source, $sourceId)) {

        //     // (new UserService())->login($auth->user->email);

        //     Yii::$app->user->login($auth->user->email);
        //     return $this->goHome();
        // }


        // if ($email) {
        //     $userEmail = Users::find()
        //         ->where(['email' => $email])
        //         ->one();

        //     if ($userEmail) {
        //         // (new AuthService())->create($user->id, $source, $sourceId);
        //         Yii::$app->user->login($auth->user->email);
        //         return $this->goHome();
        //     }

        // Yii::$app->user->login($user); //Вызываем логин пользователя средствами встроенного компонента User;

        // $this->redirect('/tasks/index'); // Переадресуем на страницу списка задач;

        // elseif ((new UserService())->signupVKUser($attributes, $source)) {
        //     (new UserService())->login($email);
        // }
        // }


        // if ($email = ArrayHelper::getValue($attributes, 'email')) {

        //     if ($user = (new UserService())->findByEmail($email)) {
        //         (new AuthService())->create($user->id, $source, $sourceId);
        //         (new UserService())->login($email);
        //     } elseif ((new UserService())->signupVKUser($attributes, $source)) {
        //         (new UserService())->login($email);
        //     }
        // }

        // $source = $client->getId();

        // print($sourceId);
        // print('<br>');
        // print($nickname);
        // print('<br>');
        // print_r($attributes);
        // exit;

        // if ($auth = (new AuthService())->findOne($source, $sourceId)) {
        //     (new UserService())->login($auth->user->email);
        // } elseif ($email = ArrayHelper::getValue($attributes, 'email')) {

        //     if ($user = (new UserService())->findByEmail($email)) {
        //         (new AuthService())->create($user->id, $source, $sourceId);
        //         (new UserService())->login($email);
        //     } elseif ((new UserService())->signupVKUser($attributes, $source)) {
        //         (new UserService())->login($email);
        //     }
        // }

        return $this->goHome();
    }

    // Применяет правила авторизации к контроллерам;
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::class,
    //             'only' => ['registration'],
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                     'actions' => ['registration'],
    //                     'matchCallback' => function ($rule, $action) {
    //                         return CustomHelpers::checkAuthorization() === null;
    //                     }
    //                 ]
    //             ]
    //         ]
    //     ];
    // }

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
