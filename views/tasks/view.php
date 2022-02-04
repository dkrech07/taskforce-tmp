<?php

use yii\helpers\Html;
use TaskForce\utils\NounPluralConverter;
use TaskForce\utils\CustomHelpers;
?>

<div class="left-column">
    <div class="head-wrapper">
        <h3 class="head-main"><?= Html::encode($task->name) ?></h3>
        <p class="price price--big"><?= Html::encode($task->budget) ?></p>
    </div>
    <p class="task-description"><?= Html::encode($task->description) ?></p>
    <a href="#" class="button button--blue">Откликнуться на задание</a>
    <div class="task-map">
        <img class="map" src="/img/map.png" width="725" height="346" alt="<?= Html::encode($task->address) ?>">
        <p class="map-address town"><?= Html::encode($task->city->city) ?></p>
        <p class="map-address"><?= Html::encode($task->address) ?></p>
    </div>
    <h4 class="head-regular">Отклики на задание</h4>

    <?php foreach ($replies as $reply) : ?>
        <div class="response-card">
            <img class="customer-photo" src="<?= (Html::encode($reply->executor->avatar_link)) ?>" width="146" height="156" alt="Фото заказчиков">
            <div class="feedback-wrapper">
                <a href="#" class="link link--block link--big"></a>
                <div class="response-wrapper">
                    <div class="stars-rating small">
                        <?= CustomHelpers::getRatingStars(Html::encode($reply->executor->average_rating)) ?>
                    </div>
                    <p class="reviews"><?= (count($reply->opinion)) ?> <?= NounPluralConverter::getOpinionsTitle(count($reply->opinion)) ?></p>
                </div>
                <p class="response-message">
                    <?= Html::encode($reply->description) ?>
                </p>

            </div>
            <div class="feedback-wrapper">
                <p class="info-text"><span class="current-time"><?= NounPluralConverter::getTaskRelativeTime($reply->dt_add) ?></span></p>
                <p class="price price--small"><?= Html::encode($reply->rate) ?> ₽</p>
            </div>
            <div class="button-popup">
                <a href="#" class="button button--blue button--small">Принять</a>
                <a href="#" class="button button--orange button--small">Отказать</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="right-column">
    <div class="right-card black info-card">
        <h4 class="head-card">Информация о задании</h4>
        <dl class="black-list">
            <dt>Категория</dt>
            <dd><?= Html::encode($task->category->name) ?></dd>
            <dt>Дата публикации</dt>
            <dd><?= NounPluralConverter::getTaskRelativeTime($task->dt_add) ?></dd>
            <dt>Срок выполнения</dt>
            <dd><?= date("j F Y, g:i a", strtotime(Html::encode($task->deadline))) ?></dd>
            <dt>Статус</dt>
            <dd><?= CustomHelpers::getTaskStatusName(Html::encode($task->status)) ?></dd>
        </dl>
    </div>
    <div class="right-card white file-card">
        <h4 class="head-card">Файлы задания</h4>
        <ul class="enumeration-list">
            <li class="enumeration-item">
                <a href="#" class="link link--block link--clip">my_picture.jpg</a>
                <p class="file-size">356 Кб</p>
            </li>
            <li class="enumeration-item">
                <a href="#" class="link link--block link--clip">information.docx</a>
                <p class="file-size">12 Кб</p>
            </li>
        </ul>
    </div>
</div>