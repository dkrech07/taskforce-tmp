<?php

namespace app\models;

use yii\base\Model;

class TasksSearchForm extends Model
{
    public $categories;
    public $without_executor;
    public $period;

    const PERIOD_VALUES = [
        '0' => 'За все время',
        '1' => '1 час',
        '12' => '12 часов',
        '24' => '24 часа',
        '262800' => '30 лет', // Протестить большие периоды;
    ];

    public function rules()
    {
        return [
            [['categories'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => 'id', 'allowArray' => true],
            ['without_executor', 'boolean'],
            ['period', 'in', 'range' => array_keys(self::PERIOD_VALUES)]
        ];
    }

    public function attributeLabels()
    {
        return [
            'without_executor' => 'Без исполнителя'
        ];
    }
}
