<?php

namespace app\services;

use app\models\Categories;

class CategoriesService
{
    public function findAll(): array
    {
        return Categories::find()->all();
    }

    // public function getByInnerName(string $inner_name): ?Categories
    // {
    //     return Categories::findOne(['inner_name' => $inner_name]);
    // }
}
