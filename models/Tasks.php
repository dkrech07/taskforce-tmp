<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $dt_add
 * @property int $category_id
 * @property string|null $description
 * @property string $name
 * @property int $customer_id заказчик
 * @property string|null $deadline срок выполнения задания
 * @property string|null $fin_date фактический срок выполнения задания
 * @property string|null $address
 * @property int|null $budget
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $status
 * @property int|null $executor_id заказчик
 * @property int|null $city_id город
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dt_add', 'category_id', 'name', 'customer_id'], 'required'],
            [['dt_add', 'deadline', 'fin_date'], 'safe'],
            [['category_id', 'customer_id', 'budget', 'executor_id', 'city_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'address', 'latitude', 'longitude', 'status'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dt_add' => 'Dt Add',
            'category_id' => 'Category ID',
            'description' => 'Description',
            'name' => 'Name',
            'customer_id' => 'Customer ID',
            'deadline' => 'Deadline',
            'fin_date' => 'Fin Date',
            'address' => 'Address',
            'budget' => 'Budget',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'status' => 'Status',
            'executor_id' => 'Executor ID',
            'city_id' => 'City ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Users::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(Users::className(), ['id' => 'executor_id']);
    }

    /**
     * Gets query for [[Replies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Replies::className(), ['task_id' => 'id']);
    }
}
