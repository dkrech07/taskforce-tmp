<?php

use yii\db\Migration;

/**
 * Class m220116_211335_create_table_users
 */
class m220116_211335_create_table_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(128)->notNull()->unique(),
            'name' => $this->string(128)->notNull(),
            'password' => $this->string(64)->notNull(),
            'dt_add' => $this->dateTime()->notNull(),
            'profile_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
