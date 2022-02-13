<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property string|null $about
 * @property string|null $avatar_link
 * @property float|null $average_rating
 * @property string|null $address
 * @property string|null $bd
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $messanger
 * @property int $user_id
 */
class Profiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['about'], 'string'],
            [['average_rating'], 'number'],
            [['avatar_link', 'address', 'bd', 'phone', 'skype', 'messanger'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'about' => 'About',
            'avatar_link' => 'Avatar Link',
            'average_rating' => 'Average Rating',
            'address' => 'Address',
            'bd' => 'Bd',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'messanger' => 'Messanger',
            'user_id' => 'User ID',
        ];
    }

    // /**
    //  * Gets query for [[Users]].
    //  *
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getUsers()
    // {
    //     return $this->hasMany(Users::className(), ['profile_id' => 'id']);
    // }

    // /** Gets query for [[User]].
    //  *
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getUser()
    // {
    //     return $this->hasOne(Users::className(), ['profile_id' => 'id']);
    // }
}
