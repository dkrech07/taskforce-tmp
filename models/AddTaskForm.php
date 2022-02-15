<?php

namespace app\models;

use yii\base\Model;
use app\models\Categories;
use app\models\Cities;

class AddTaskForm extends Model
{
    public $name;
    public $description;
    public $category_id;
    public $location;
    public $latitude;
    public $longitude;
    public $city_name;
    public $budget;
    public $expire;
    public $files;

    public function rules()
    {
        return [
            [['name', 'description'], 'trim'], // Обрезаем пустые входные данные в Null с помощью trim;
            [['name', 'description', 'category_id'], 'required'], // Задаем обязательные поля;
            [['name'], 'string', 'length' => [10, 128]], // Задаем тип данных для поля "Имя" и максимальную и минимальную длину;
            [['description'], 'string', 'length' => [30, 255]], // Задаем тип поля и длину для "Описания";
            [['category_id'], 'integer'], // Категория - всегда число;
            [['category_id'], 'exist', 'targetClass' => Categories::class, 'targetAttribute' => 'id'], // Категория: првоеряем на существование, ссылаемся на таблицу Категорий по id;
            [['location', 'city_name'], 'string'], // Локация, название города - текстовые данные;
            [['latitude', 'longitude'], 'string'], // Широта и долгота - текстовые данные;
            [['city_name'], 'exist', 'targetClass' => Cities::class, 'targetAttribute' => 'name'], // Название города: проверяем на существование, ссылаемся на таблицу с городами по названию (имени) города;
            [['budget'], 'integer', 'min' => 1], // Бюджет - числовое значение, задаем минимальную сумму;
            [
                ['expire'], 'date', 'format' => 'php:Y-m-d', 'min' => strtotime('today'), // Проверку даты я украл;
                'tooSmall' => 'Дата не может быть раньше текущего дня.'
            ],
            [['files'], 'file', 'maxFiles' => 10], // Пусть будет пока так;
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Опишите суть работы',
            'description' => 'Подробности задания',
            'category_id' => 'Категория',
            'location' => 'Локация',
            'budget' => 'Бюджет',
            'expire' => 'Срок исполнения',
            'files' => 'Добавить новый файл',
        ];
    }
}
