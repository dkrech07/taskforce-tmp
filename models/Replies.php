<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "replies".
 *
 * @property string|null $dt_add
 * @property int $rate
 * @property string|null $description
 * @property int|null $executor_id
 * @property int|null $task_id
 *
 * @property Profiles $executor
 * @property Tasks $task
 * @property Opinions $opinion
 */
class Replies extends \yii\db\ActiveRecord
{
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
            [['dt_add'], 'safe'],
            [['rate'], 'required'],
            [['rate', 'executor_id', 'task_id'], 'integer'],
            [['description'], 'string'],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profiles::className(), 'targetAttribute' => ['executor_id' => 'user_id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
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
            'executor_id' => 'Executor ID',
            'task_id' => 'Task ID',
        ];
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'executor_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'executor_id']);
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
     * Gets query for [[Opinion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpinion()
    {
        return $this->hasMany(Opinions::className(), ['executor_id' => 'executor_id']);
    }
}
