<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<section class="modal modal-hide form-modal" id="refuse-form">
    <?= Html::tag('h2', 'Отказ от выполнения задания') ?>

    <?php $form = ActiveForm::begin(['id' => 'modal-form']); ?>

    <?= $form->field($formModel, 'description')->textarea(['autofocus' => true]) ?>

    <div class="form-group">
        <button type="submit" class="modal-button" form="modal-form" name="refuse" value="refuse">Отказаться</button>
        <button type="button" class="modal-button close-button" data-dismiss="modal">Вернуться</button>
    </div>

    <?php ActiveForm::end(); ?>

</section>