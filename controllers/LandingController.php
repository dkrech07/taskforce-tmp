<?php

namespace app\controllers;

use Yii;
use yii\widgets\ActiveForm;
use app\models\LoginForm;
use yii\web\Controller;
use yii\web\Response;

class LandingController extends Controller
{
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

                return $this->goHome(); // Переадресуем на главную страницу;
            }
        }

        return $this->render('index', ['loginForm' => $loginForm]); //Показываем страницу с передачей в шаблон модели для формы входа;
    }
}
