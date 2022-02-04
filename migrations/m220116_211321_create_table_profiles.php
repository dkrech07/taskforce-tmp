<?php

use yii\db\Migration;

/**
 * Class m220116_211321_create_table_profiles
 */
class m220116_211321_create_table_profiles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profiles}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string(128)->notNull(),
            'bd' => $this->string(128)->notNull(),
            'about' => $this->text()->null(),
            'phone' => $this->string(128)->notNull(),
            'skype' => $this->string(128)->notNull(),
            'messanger' => $this->string(128)->null(),
            'role' => $this->integer()->null(),
            'city_id' => $this->integer()->null(),
            'average_rating' => $this->integer()->null(),
            'avatar_link' => $this->string(128)->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');
    }
}
