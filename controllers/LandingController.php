<?php

namespace app\controllers;

use Yii;
use yii\widgets\ActiveForm;
use app\models\LoginForm;
use yii\web\Controller;
use yii\web\Response;
use TaskForce\utils\CustomHelpers;
use yii\filters\AccessControl;

class LandingController extends Controller
{
    // Применяет правила авторизации к контроллерам;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'matchCallback' => function ($rule, $action) {
                            return CustomHelpers::checkAuthorization() === null;
                        }
                    ]
                ]
            ]
        ];
    }

    public $layout = 'landing';

    public function actionIndex()
    {
        $loginForm = new LoginForm();

        if (Yii::$app->request->getIsPost()) {
            $loginForm->load(\Yii::$app->request->post()); // Проверим, что форма отправлена и загрузим в неё данные из ПОСТа;

            if (Yii::$app->request->isAjax) { //  Добавим проверку на AJAX-запрос, поменяем формат ответа и вернём результат в формате JSON;
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($loginForm);
            }

            if ($loginForm->validate()) { // Запустим валидацию формы;
                $user = $loginForm->getUser(); // Если валидация прошла, то получим модель найденного пользователя из формы;
                Yii::$app->user->login($user); //Вызываем логин пользователя средствами встроенного компонента User;

                $this->redirect('/tasks/index'); // Переадресуем на страницу списка задач;
            }
        }

        return $this->render('index', ['loginForm' => $loginForm]); //Показываем страницу с передачей в шаблон модели для формы входа;
    }

    // Редиректит на список задач, если уже авторизован;
    public function beforeAction($action)
    {
        if (CustomHelpers::checkAuthorization() !== null) {
            $this->redirect('/tasks/index');
            return false;
        }

        return true;
    }
}
