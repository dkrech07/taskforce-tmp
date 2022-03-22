<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<div class="main-content main-content--left container">
    <div class=" left-menu left-menu--edit">
        <h3 class="head-main head-task">Настройки</h3>
        <ul class="side-menu-list">
            <li class="side-menu-item side-menu-item--active">
                <a class="link link--nav">Мой профиль</a>
            </li>
            <li class="side-menu-item">
                <a href="#" class="link link--nav">Безопасность</a>
            </li>
            <li class="side-menu-item">
                <a href="#" class="link link--nav">Уведомления</a>
            </li>
        </ul>
    </div>
    <div class="my-profile-form">

        <!-- <form> -->

        <?php $form = ActiveForm::begin([
            'id' => 'registration-form',
            'options' => ['autocomplete' => 'off']
        ]); ?>

        <h3 class="head-main head-regular">Мой профиль</h3>
        <div class="photo-editing">
            <div>
                <p class="form-label">Аватар</p>
                <img class="avatar-preview" src="<?= Url::to($userProfile->profile->avatar_link); ?>" width="83" height="83">
            </div>
            <input hidden value="Сменить аватар" type="file" id="button-input">
            <label for="button-input" class="button button--black"> Сменить аватар</label>
        </div>

        <div class="form-group">
            <?= $form->field($EditProfileFormModel, 'name')->textInput(); ?>
        </div>

        <div class="half-wrapper">
            <div class="form-group">
                <?= $form->field($EditProfileFormModel, 'name')->textInput(); ?>
            </div>
            <div class="form-group">
                <?= $form->field($EditProfileFormModel, 'bd', ['enableAjaxValidation' => true])->input('date', ['placeholder' => 'гггг-мм-дд']) ?>
            </div>
        </div>
        <div class="half-wrapper">
            <div class="form-group">
                <?= $form->field($EditProfileFormModel, 'phone')->textInput(); ?>
            </div>
            <div class="form-group">
                <?= $form->field($EditProfileFormModel, 'messanger')->textInput(); ?>

            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="profile-info">Информация о себе</label>
            <textarea id="profile-info"></textarea>
            <span class="help-block">Error description is here</span>
            <!-- <?= $form->field($EditProfileFormModel, 'about')->textarea() ?> -->

        </div>
        <div class="form-group">
            <p class="form-label">Выбор специализаций</p>
            <div class="checkbox-profile">

                <?= $form->field($EditProfileFormModel, 'categories')->dropDownList(ArrayHelper::map($categories, 'id', 'name')); ?>


                <!-- <label class="control-label" for="сourier-services">
                    <input type="checkbox" id="сourier-services" checked>
                    Курьерские услуги</label>
                <label class="control-label" for="cargo-transportation">
                    <input id="cargo-transportation" type="checkbox">
                    Грузоперевозки</label>
                <label class="control-label" for="cleaning">
                    <input id="cleaning" type="checkbox">
                    Клининг</label>
                <label class="control-label" for="computer-help">
                    <input id="computer-help" type="checkbox" checked>
                    Компьютерная помощь</label> -->
            </div>
        </div>

        <!-- <input type="submit" class="button button--blue" value="Сохранить"> -->

        <?= Html::submitInput('Сохранитьт', [
            'class' => 'button button--blue',
            // 'style' => 'width: 660px;'
        ]); ?>

        <!-- </form> -->
        <?php ActiveForm::end(); ?>

    </div>
</div>