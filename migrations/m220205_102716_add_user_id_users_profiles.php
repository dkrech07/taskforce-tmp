<?php

use yii\db\Migration;

/**
 * Class m220205_102716_add_user_id_users_profiles
 */
class m220205_102716_add_user_id_users_profiles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%profiles}}', 'id');
        $this->addColumn('{{%profiles}}', 'user_id', $this->primaryKey());


        $this->dropColumn('{{%users}}', 'profile_id');
        $this->addColumn('{{%users}}', 'id', $this->primaryKey());
    }
}
