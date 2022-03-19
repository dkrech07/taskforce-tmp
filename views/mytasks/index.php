<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use TaskForce\utils\NounPluralConverter;
use yii\widgets\Menu;

$currentMyTasksUrl = Yii::$app->request->url;
?>

<div class="left-menu">
    <h3 class="head-main head-task">Мои задания</h3>
    <ul class="side-menu-list">

        <?php
        $myItems = [
            ['label' => 'Новые', 'url' => ['/mytasks/new', 'filter' => 'new']],
            ['label' => 'В процессе', 'url' => ['/mytasks/in_progress', 'filter' => 'progress']],
            ['label' => 'Закрытые', 'url' => ['/mytasks/finished', 'filter' => 'closed']]
        ];

        ?>

        <?= Menu::widget([
            'items' => $myItems,
            'activeCssClass' => 'side-menu-item--active',
            'itemOptions' => ['class' => 'side-menu-item'],
            'labelTemplate' => '<a class="link link--nav">{label}</a>',
            'linkTemplate' => '<a href="{url}" class="link link--nav">{label}</a>',
            'options' => ['class' => 'side-menu-list']
        ]); ?>

        <!-- <li class="side-menu-item <?= $currentMyTasksUrl === '/mytasks/new' || $currentMyTasksUrl === '/mytasks/' ? 'side-menu-item--active' : '' ?>">
            <a href="<?= Url::to(['mytasks/new']); ?>" class="link link--nav">Новые</a>
        </li>
        <li class="side-menu-item <?= $currentMyTasksUrl === '/mytasks/in_progress' ? 'side-menu-item--active' : '' ?>">
            <a href="<?= Url::to(['mytasks/in_progress']); ?>" class="link link--nav">В процессе</a>
        </li>
        <li class="side-menu-item <?= $currentMyTasksUrl === '/mytasks/finished' ? 'side-menu-item--active' : '' ?>">
            <a href="<?= Url::to(['mytasks/finished']); ?>" class="link link--nav">Закрытые</a>
        </li> -->
    </ul>
</div>
<div class="left-column left-column--task">
    <h3 class="head-main head-regular">Новые задания</h3>

    <?php foreach ($myTasks as $task) : ?>
        <div class="task-card">
            <div class="header-task">
                <a href="<?= Url::to(['tasks/view', 'id' => $task->id]); ?>" class="link link--block link--big"><?= Html::encode($task->name); ?></a>
                <p class="price price--task"><?= Html::encode($task->budget); ?> <?= Html::encode(isset($task->budget)) ? '₽' : ''; ?> </p>
            </div>
            <p class="info-text"><span class="current-time"><?= NounPluralConverter::getTaskRelativeTime($task->dt_add); ?></span></p>
            <p class="task-text"><?= Html::encode($task->description); ?></p>
            <div class="footer-task">
                <p class="info-text town-text"><?= Html::encode($task->address); ?></p>
                <p class="info-text category-text"><?= Html::encode($task->category->name); ?></p>
                <a href="<?= Url::to(['tasks/view', 'id' => $task->id]); ?>" class="button button--black">Смотреть Задание</a>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- <div class="task-card">
        <div class="header-task">
            <a href="#" class="link link--block link--big">Перевести войну и мир на клингонский</a>
            <p class="price price--task">3400 ₽</p>
        </div>
        <p class="info-text"><span class="current-time">4 часа </span>назад</p>
        <p class="task-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor
            nibh finibus et. Aenean eu enim justo. Vestibulum aliquam hendrerit molestie. Mauris malesuada nisi sit amet augue accumsan tincidunt.
        </p>
        <div class="footer-task">
            <p class="info-text town-text">Санкт-Петербург, Центральный район</p>
            <p class="info-text category-text">Переводы</p>
            <a href="#" class="button button--black">Смотреть Задание</a>
        </div>
    </div>
    <div class="task-card">
        <div class="header-task">
            <a href="#" class="link link--block link--big">Перевести войну и мир на клингонский</a>
            <p class="price price--task">3400 ₽</p>
        </div>
        <p class="info-text"><span class="current-time">4 часа </span>назад</p>
        <p class="task-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor
            nibh finibus et. Aenean eu enim justo. Vestibulum aliquam hendrerit molestie. Mauris malesuada nisi sit amet augue accumsan tincidunt.
        </p>
        <div class="footer-task">
            <p class="info-text town-text">Санкт-Петербург, Центральный район</p>
            <p class="info-text category-text">Переводы</p>
            <a href="#" class="button button--black">Смотреть Задание</a>
        </div>
    </div> -->
</div>