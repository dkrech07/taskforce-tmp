<?php
// Тестовый сценарий;

// Подключаю контроллеры для показа записей таблиц Категорий и Профилей;
use app\controllers\CategoriesController;
use app\controllers\ProfilesController;

// Получаю и вывожу первую запись таблицы "Категории";
$categories = new CategoriesController();
$categories->actionIndex();
print('<br>');

// Получаю и вывожу произвольную запись таблицы "Профили";
$profiles = new ProfilesController(5);
$profiles->actionIndex();

?>

<!-- <p>Hello world</p> -->