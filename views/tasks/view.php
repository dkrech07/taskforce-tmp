<?php

use yii\helpers\Html;
use TaskForce\utils\NounPluralConverter;
use TaskForce\utils\CustomHelpers;
use app\widgets\ModalForm;
use app\assets\ModalFormAsset;

$apiKey = Yii::$app->params['geocoderApiKey']; // Прокидываю api-ключ;
$this->registerJsFile("https://api-maps.yandex.ru/2.1/?apikey={$apiKey}&lang=ru_RU"); // Подключаю api;
$this->registerJsFile('/js/yandex-map.js'); // Подключаю карту;

ModalFormAsset::register($this);

$userId = Yii::$app->user->getId();

$action = $taskAction->get_action_code();

?>

<div class="left-column">
    <div class="head-wrapper">
        <h3 class="head-main"><?= Html::encode($task->name); ?></h3>
        <p class="price price--big"><?= Html::encode($task->budget); ?></p>
    </div>
    <p class="task-description"><?= Html::encode($task->description); ?></p>

    <!-- Исполнитель. Оставить отклик на задание; -->
    <?php if ($action === 'ACTION_RESPOND' && CustomHelpers::checkExecutor($replies, $userId)) : ?>
        <a href="#" class="button button--blue response-button">Откликнуться на задание</a>
        <?= ModalForm::widget(['formType' => 'responseForm', 'formModel' => $responseFormModel]) ?>
    <?php endif; ?>

    <!-- Исполнитель. Отказаться от выполнения задания; -->
    <?php if ($action === 'ACTION_REFUSED') : ?>
        <a href="#" class="button button--blue refuse-button">Отказаться от задания</a>
        <?= ModalForm::widget(['formType' => 'refuseForm', 'formModel' => $refuseFormModel]) ?>
    <?php endif; ?>

    <!-- Постановщник. Завершение задания; -->
    <?php if ($action === 'ACTION_FINISHED') : ?>
        <a href="#" class="button button--blue finished-button">Завершить задание</a>
        <?= ModalForm::widget(['formType' => 'finishedForm', 'formModel' => $finishedFormModel]) ?>
    <?php endif; ?>

    <!-- Постановщик. Отменить задание; -->
    <?php if ($action === 'ACTION_CANCELED') : ?>
        <a href="<?= '/cancel/' . $task->id ?>" class="button button--blue">Отменить задание</a>
    <?php endif; ?>

    <?php if (isset($task->latitude, $task->longitude)) : ?>
        <div class="task-map">
            <div id="map" style="width: 725px; height: 346px" data-latitude="<?= Html::encode($task->latitude) ?>" data-longitude="<?= Html::encode($task->longitude) ?>"></div>
            <p class="map-address town"><?= Html::encode($task->city->city); ?></p>
            <p class="map-address"><?= Html::encode($task->address) ?></p>
        </div>
    <?php endif; ?>

    <?php if (CustomHelpers::checkCustomerOrExecutor($replies, $task, $userId)) : ?>
        <h4 class="head-regular">Отклики на задание</h4>
    <?php endif; ?>

    <?php foreach ($replies as $reply) : ?>
        <?php if ($reply->executor_id === $userId || $task->customer_id === $userId) : ?>
            <div class="response-card">
                <img class="customer-photo" src="<?= (Html::encode($reply->executor->avatar_link)); ?>" width="146" height="156" alt="Фото заказчиков">
                <div class="feedback-wrapper">
                    <a href="/user/view/<?= Html::encode($reply->user->id); ?>" class="link link--block link--big"><?= Html::encode($reply->user->name); ?></a>
                    <div class="response-wrapper">
                        <div class="stars-rating small">
                            <?= CustomHelpers::getRatingStars(Html::encode($reply->executor->average_rating)); ?>
                        </div>
                        <p class="reviews"><?= (count($reply->opinion)); ?> <?= NounPluralConverter::getOpinionsTitle(count($reply->opinion)); ?></p>
                    </div>
                    <p class="response-message">
                        <?= Html::encode($reply->description); ?>
                    </p>

                </div>
                <div class="feedback-wrapper">
                    <p class="info-text"><span class="current-time"><?= NounPluralConverter::getTaskRelativeTime($reply->dt_add); ?></span></p>
                    <p class="price price--small"><?= Html::encode($reply->rate); ?> ₽</p>
                </div>
                <?php if ($task->customer_id === $userId && !isset($reply->status) && CustomHelpers::checkRepliesStatus($replies)) : ?>
                    <div class="button-popup">
                        <a href="<?= '/accept/' . $reply->id ?>" class="button button--blue button--small">Принять</a>
                        <a href="<?= '/reject/' . $reply->id ?>" class="button button--orange button--small">Отказать</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>



</div>

<div class="right-column">
    <div class="right-card black info-card">
        <h4 class="head-card">Информация о задании</h4>
        <dl class="black-list">
            <dt>Категория</dt>
            <dd><?= Html::encode($task->category->name); ?></dd>
            <dt>Дата публикации</dt>
            <dd><?= NounPluralConverter::getTaskRelativeTime($task->dt_add); ?></dd>
            <dt>Срок выполнения</dt>
            <dd><?= Html::encode(CustomHelpers::checkNullDate($task->deadline)); ?></dd>
            <dt>Статус</dt>
            <dd><?= CustomHelpers::getTaskStatusName(Html::encode($task->status)); ?></dd>
        </dl>
    </div>

    <?php if (count($task_files) > 0) : ?>
        <div class="right-card white file-card">
            <h4 class="head-card">Файлы задания</h4>
            <ul class="enumeration-list">
                <?php foreach ($task_files as $task_file) : ?>
                    <li class="enumeration-item">
                        <a target="_blank" href="<?= '/uploads/' . $task_file->link ?>" class="link link--block link--clip"><?= $task_file->link ?></a>
                        <p class="file-size"><?= CustomHelpers::getFileSize($task_file->link) ?> Кб</p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

</div>