<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<section class="modal modal-hide form-modal" id="finished-form">
    <?= Html::tag('h2', 'Завершить задание: ') ?>

    <?php $form = ActiveForm::begin(['id' => 'modal-form']); ?>

    <?= $form->field($formModel, 'description')->textarea(['autofocus' => true]) ?>

    <?= $form->field($formModel, 'rating')->input('number', ['min' => '0', 'max' => '5']) ?>

    <div class="stars-rating big">
        <label class="star-label fill-star-modal">&nbsp;<input class="fill-star-radio" type="radio" name="response" value="1"></label>
        <label class="star-label fill-star-modal">&nbsp;<input class="fill-star-radio" type="radio" name="response" value="2"></label>
        <label class="star-label fill-star-modal">&nbsp;<input class="fill-star-radio" type="radio" name="response" value="3"></label>
        <label class="star-label fill-star-modal">&nbsp;<input class="fill-star-radio" type="radio" name="response" value="4"></label>
        <label class="star-label fill-star-modal">&nbsp;<input class="fill-star-radio" type="radio" name="response" value="5"></label>
    </div>

    <div class="form-group">
        <button type="submit" class="modal-button" form="modal-form" name="finished" value="finished">Завершить</button>
        <button type="button" class="modal-button close-button" data-dismiss="modal">Вернуться</button>
    </div>
    <?php ActiveForm::end(); ?>

</section>