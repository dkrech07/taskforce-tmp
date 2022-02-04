<?php

use yii\db\Migration;

/**
 * Class m220116_211304_create_table_cities
 */
class m220116_211304_create_table_cities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cities}}', [
            'id' => $this->primaryKey(),
            'city' => $this->string(128)->notNull(),
            'latitude' => $this->string(128)->notNull(),
            'longitude' => $this->string(128)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cities}}');
    }
}
