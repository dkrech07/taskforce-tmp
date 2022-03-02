<?php

namespace app\models;

use Yii;
use yii\base\Model;


class ResponseForm extends Model
{
    public $description;
    public $rate;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'replies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['rate'], 'required'],
            [['description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rate' => 'Ваша цена:',
            'description' => 'Комментарий:',
        ];
    }
}
