<?php

namespace app\controllers;

use app\models\Categories;

class CategoriesController
{
    public function actionIndex()
    {
        $category = Categories::find()->one();
        if ($category) {
            print("Первая запись таблицы 'Категории:'" . '<br>');
            print($category->id . '<br>');
            print($category->name . '<br>');
            print($category->icon . '<br>');
        }
    }
}
