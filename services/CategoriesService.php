<?php

namespace app\services;

use app\models\Categories;

class CategoriesService
{
    public function findAll(): array
    {
        return Categories::find()->all();
    }
}
