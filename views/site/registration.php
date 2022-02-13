<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="center-block">
    <div class="registration-form regular-form">

        <?php $form = ActiveForm::begin([
            'id' => 'registration-form',
            'options' => ['autocomplete' => 'off']
        ]); ?>

        <h3 class="head-main head-task">Регистрация нового пользователя</h3>

        <div class="form-group">
            <?= $form->field($model, 'name')->textInput(); ?>
        </div>

        <div class="half-wrapper">
            <div class="form-group">
                <?= $form->field($model, 'email')->input('email'); ?>
            </div>

            <div class="form-group">
                <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map($cities, 'id', 'city')); ?>
            </div>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput(); ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'password_repeat')->passwordInput(); ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'role')->checkbox(); ?>
        </div>

        <?= Html::submitInput('Создать аккаунт', [
            'class' => 'button button--blue',
            'style' => 'width: 660px;'
        ]); ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>