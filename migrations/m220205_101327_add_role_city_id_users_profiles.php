<?php

use yii\db\Migration;

/**
 * Class m220205_101327_add_role_city_id_users_profiles
 */
class m220205_101327_add_role_city_id_users_profiles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%profiles}}', 'city_id');
        $this->dropColumn('{{%profiles}}', 'role');

        $this->addColumn('{{%users}}', 'city_id', $this->integer()->null());
        $this->addColumn('{{%users}}', 'role', $this->integer()->null());
    }
}
