<?php

use yii\bootstrap4\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use TaskForce\utils\CustomHelpers;

AppAsset::register($this);

$user = CustomHelpers::checkAuthorization();

if ($user) {
    $userName = $user->name;
    $userProfile = CustomHelpers::getUserProfile($user->id);
} else {
    $userName = 'Анонимный пользователь';
}
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php $this->registerCsrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>

<body>
    <?php $this->beginBody(); ?>

    <header class="page-header">
        <nav class="main-nav">
            <a href='<?= Url::to('/') ?>' class="header-logo">
                <img class="logo-image" src="/img/logotype.png" width=227 height=60 alt="taskforce">
            </a>
            <?php if (Url::current() !== Url::to(['site/registration'])) : ?>
                <div class="nav-wrapper">
                    <ul class="nav-list">
                        <li class="list-item list-item--active">
                            <a class="link link--nav">Новое</a>
                        </li>
                        <li class="list-item">
                            <a href="#" class="link link--nav">Мои задания</a>
                        </li>
                        <?php if ($user->role === 0) : ?>
                            <li class="list-item">
                                <a href="<?= Url::to('/tasks/add') ?>" class="link link--nav">Создать задание</a>
                            </li>
                        <?php endif; ?>
                        <li class="list-item">
                            <a href="#" class="link link--nav">Настройки</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </nav>

        <?php if (Url::current() !== Url::to(['site/registration'])) : ?>
            <div class="user-block">
                <a href="#">
                    <img class="user-photo" src="<?= Url::to($userProfile->avatar_link); ?>" width="55" height="55" alt="Аватар">
                </a>
                <div class="user-menu">
                    <p class="user-name"><?= $userName ?></p>
                    <div class="popup-head">
                        <ul class="popup-menu">
                            <li class="menu-item">
                                <a href="#" class="link">Настройки</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="link">Связаться с нами</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?= Url::to('/site/logout'); ?>" class="link">Выход из системы</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </header>

    <main class="main-content container">
        <?= $content ?>
    </main>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>