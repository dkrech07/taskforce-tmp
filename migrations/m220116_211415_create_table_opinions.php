<?php

use yii\db\Migration;

/**
 * Class m220116_211415_create_table_opinions
 */
class m220116_211415_create_table_opinions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%opinions}}', [
            'dt_add' => $this->dateTime()->notNull(),
            'rate' => $this->integer()->notNull(),
            'description' => $this->text()->null(),
            'customer_id' => $this->integer()->notNull()->comment('заказчик'),
            'executor_id' => $this->integer()->notNull()->comment('исполнитель'),
            'task_id' => $this->integer()->notNull(),
            'rating' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%opinions}}');
    }
}
