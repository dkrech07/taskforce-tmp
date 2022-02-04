<?php

use yii\db\Migration;

/**
 * Class m220201_093036_update_settings_profiles
 */
class m220201_093036_update_settings_profiles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%users}}', 'profile_id');
        $this->dropColumn('{{%users}}', 'id');
        $this->addColumn('{{%users}}', 'profile_id', $this->primaryKey());

        $this->dropColumn('{{%profiles}}', 'address');
        $this->addColumn('{{%profiles}}', 'address', $this->string(128)->null());

        $this->dropColumn('{{%profiles}}', 'bd');
        $this->addColumn('{{%profiles}}', 'bd', $this->string(128)->null());

        $this->dropColumn('{{%profiles}}', 'phone');
        $this->addColumn('{{%profiles}}', 'phone', $this->string(128)->null());

        $this->dropColumn('{{%profiles}}', 'skype');
        $this->addColumn('{{%profiles}}', 'skype', $this->string(128)->null());

        $this->dropColumn('{{%profiles}}', 'messanger');
        $this->addColumn('{{%profiles}}', 'messanger', $this->string(128)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
