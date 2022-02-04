<?php

use yii\bootstrap4\Html;
use yii\widgets\ActiveForm;
// print_r($loginForm);
?>

<section class="modal enter-form form-modal" id="enter-form">
    <h2>Вход на сайт</h2>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'action' => 'login',
        'enableAjaxValidation' => true,
        'options' => ['autocomplete' => 'off'],
        'fieldConfig' => [
            'labelOptions' => ['class' => 'form-modal-description'],
            'inputOptions' => ['class' => 'enter-form-email input input-middle']
        ]
    ]); ?>

    <?= $form->field($loginForm, 'email')->input('email') ?>
    <?= $form->field($loginForm, 'password')->passwordInput() ?>

    <?= Html::submitButton('Войти', ['class' => 'button']) ?>

    <?php $form = ActiveForm::end(); ?>

    <button class="form-modal-close" type="button">Закрыть</button>
</section>

<!-- <section class="modal enter-form form-modal" id="enter-form">
    <h2>Вход на сайт</h2>
    <form action="#" method="post">
        <p>
            <label class="form-modal-description" for="enter-email">Email</label>
            <input class="enter-form-email input input-middle" type="email" name="enter-email" id="enter-email">
        </p>
        <p>
            <label class="form-modal-description" for="enter-password">Пароль</label>
            <input class="enter-form-email input input-middle" type="password" name="enter-email" id="enter-password">
        </p>
        <button class="button" type="submit">Войти</button>
    </form>
    <button class="form-modal-close" type="button">Закрыть</button>
</section> -->

<div class="landing-container">
    <div class="landing-top">
        <h1>Работа для всех.<br>
            Найди исполнителя на любую задачу.</h1>
        <p>Сломался кран на кухне? Надо отправить документы? Нет времени самому гулять с собакой?
            У нас вы быстро найдёте исполнителя для любой жизненной ситуации?<br>
            Быстро, безопасно и с гарантией. Просто, как раз, два, три. </p>
        <button class="button">Создать аккаунт</button>
        <!-- Url::to('/site/registration')?> -->
    </div>
    <div class="landing-center">
        <div class="landing-instruction">
            <div class="landing-instruction-step">
                <div class="instruction-circle circle-request"></div>
                <div class="instruction-description">
                    <h3>Публикация заявки</h3>
                    <p>Создайте новую заявку.</p>
                    <p>Опишите в ней все детали
                        и стоимость работы.</p>
                </div>
            </div>
            <div class="landing-instruction-step">
                <div class="instruction-circle  circle-choice"></div>
                <div class="instruction-description">
                    <h3>Выбор исполнителя</h3>
                    <p>Получайте отклики от мастеров.</p>
                    <p>Выберите подходящего<br>
                        вам исполнителя.</p>
                </div>
            </div>
            <div class="landing-instruction-step">
                <div class="instruction-circle  circle-discussion"></div>
                <div class="instruction-description">
                    <h3>Обсуждение деталей</h3>
                    <p>Обсудите все детали работы<br>
                        в нашем внутреннем чате.</p>
                </div>
            </div>
            <div class="landing-instruction-step">
                <div class="instruction-circle circle-payment"></div>
                <div class="instruction-description">
                    <h3>Оплата&nbsp;работы</h3>
                    <p>По завершении работы оплатите
                        услугу и закройте задание</p>
                </div>
            </div>
        </div>
        <div class="landing-notice">
            <div class="landing-notice-card card-executor">
                <h3>Исполнителям</h3>
                <ul class="notice-card-list">
                    <li>
                        Большой выбор заданий
                    </li>
                    <li>
                        Работайте где удобно
                    </li>
                    <li>
                        Свободный график
                    </li>
                    <li>
                        Удалённая работа
                    </li>
                    <li>
                        Гарантия оплаты
                    </li>
                </ul>
            </div>
            <div class="landing-notice-card card-customer">
                <h3>Заказчикам</h3>
                <ul class="notice-card-list">
                    <li>
                        Исполнители на любую задачу
                    </li>
                    <li>
                        Достоверные отзывы
                    </li>
                    <li>
                        Оплата по факту работы
                    </li>
                    <li>
                        Экономия времени и денег
                    </li>
                    <li>
                        Выгодные цены
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>