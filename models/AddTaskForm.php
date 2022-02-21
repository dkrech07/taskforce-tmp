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
    public $deadline;
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
                ['deadline'], 'date', 'format' => 'php:Y-m-d', 'min' => strtotime('today'), // Проверка даты;
                'tooSmall' => 'Дата не может быть раньше текущего дня.'
            ],
            [['files'], 'file', 'maxFiles' => 10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Опишите суть работы', //Обязательнео поле
            'description' => 'Подробности задания', // Обязательное поле
            'category_id' => 'Категория', // Обязательное поле
            'location' => 'Локация',
            'budget' => 'Бюджет',
            'deadline' => 'Срок исполнения',
            'files' => 'Добавить новый файл',
        ];
    }
}


// Поля модели Tasks, наполняемые из формы создания задачи:
// Создаются автоматически (пользователь не выбирает значения в форме):
// 'id' => 'ID', - создается автоматически;
// 'dt_add' => 'Dt Add', - создается при создании задачи автоматически;
// 'status' => 'Status', // Для новой задачи - 'new';
// 'customer_id' => 'Customer ID', - тянется при создании формы

// Пользователь заполняет эти данные в форме создания задачи:
// 'name' => 'Name', - тянется из формы создания задачи
// 'description' => 'Description', - тянется из формы создания задачи
// 'category_id' => 'Category ID', - тянется из формы создания задачи
// 'budget' => 'Budget', - тянется из формы создания задачи
// 'deadline' => 'Deadline', - тянется из формы создания задачи
// 'file_link' => 'File Link', - тянется из формы создания задачи

// Данные о локации по условию задачи пока что не передаю:
// 'address' => 'Address', // Должен тянуться из формы создания задачи (по условию задачи 7.2 пока что его не трогаю);
// 'city_id' => 'City ID', // Должен тянуться из формы создания задачи (по условию задачи 7.2 пока что его не трогаю);
// 'latitude' => 'Latitude', // Должен тянуться из формы создания задачи (по условию задачи 7.2 пока что его не трогаю);
// 'longitude' => 'Longitude', // Должен тянуться из формы создания задачи (по условию задачи 7.2 пока что его не трогаю);

// Заполняются после назнвания исполнителя/закрытия задачи исполнителем;
// 'fin_date' => 'Fin Date', // Проставляется после закрытия задачи;
// 'executor_id' => 'Executor ID', // Проставляется при назначении исполнителя;
