<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opinions".
 *
 * @property string $dt_add
 * @property int $rate
 * @property string|null $description
 * @property int $customer_id заказчик
 * @property int $executor_id исполнитель
 * @property int $task_id
 * @property int $rating
 * @property int $id
 */
class Opinions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opinions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dt_add', 'rate', 'customer_id', 'executor_id', 'task_id', 'rating'], 'required'],
            [['dt_add'], 'safe'],
            [['rate', 'customer_id', 'executor_id', 'task_id', 'rating'], 'integer'],
            [['description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dt_add' => 'Dt Add',
            'rate' => 'Rate',
            'description' => 'Description',
            'customer_id' => 'Customer ID',
            'executor_id' => 'Executor ID',
            'task_id' => 'Task ID',
            'rating' => 'Rating',
            'id' => 'ID',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'customer_id']);
    }
}
