<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\assets\AutoCompleteAsset;

AutoCompleteAsset::register($this);

// $this->registerJsFile('/js/custom.js');
$this->title = 'Создать задание';
?>

<div class="container add-task-form regular-form">
    <?php $form = ActiveForm::begin([
        'id' => 'add-task',
    ]); ?>

    <h3 class="head-main">Публикация нового задания</h3>

    <?= $form->field($addTaskFormModel, 'name')->textInput() ?>
    <?= $form->field($addTaskFormModel, 'description')->textarea() ?>
    <?= $form->field($addTaskFormModel, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'name')) ?>
    <!-- <?= $form->field($addTaskFormModel, 'location')->textInput() ?> -->



    <?= $form->field($addTaskFormModel, 'location')->textInput(['id' => 'autoComplete', 'style' => 'padding-left: 50px;', 'data-api-url' => Url::to(['/geoapi'])]) ?>


    <div class="half-wrapper">
        <?= $form->field($addTaskFormModel, 'budget')->input('number') ?>
        <?= $form->field($addTaskFormModel, 'deadline', ['enableAjaxValidation' => true])->input('date', ['placeholder' => 'гггг-мм-дд']) ?>
    </div>

    <p class="form-label">Файлы</p>
    <div class="new-file">
        <?= $form
            ->field($addTaskFormModel, 'files[]', ['template' => "{input}{label}", 'labelOptions' => ['class' => 'add-file']])
            ->fileInput(['style' => 'display: none;', 'multiple' => true]) ?>
    </div>

    <?= $form->field($addTaskFormModel, 'latitude', ['template' => '{input}'])->hiddenInput() ?>
    <?= $form->field($addTaskFormModel, 'longitude', ['template' => '{input}'])->hiddenInput() ?>
    <?= $form->field($addTaskFormModel, 'city_name', ['template' => '{input}'])->hiddenInput() ?>

    <?= Html::submitInput('Опубликовать', ['class' => 'button button--blue']) ?>

    <?php ActiveForm::end(); ?>
</div>