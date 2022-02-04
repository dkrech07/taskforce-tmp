<?php

use yii\db\Migration;

/**
 * Class m220116_211426_create_table_replies
 */
class m220116_211426_create_table_replies extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%replies}}', [
            'dt_add' => $this->dateTime()->notNull(),
            'rate' => $this->integer()->notNull(),
            'description' => $this->text()->null(),
            'executor_id' => $this->integer()->notNull()->comment('исполнитель'),
            'task_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%replies}}');
    }
}
