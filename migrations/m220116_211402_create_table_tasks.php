<?php

use yii\db\Migration;

/**
 * Class m220116_211402_create_table_tasks
 */
class m220116_211402_create_table_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'dt_add' => $this->dateTime()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'description' => $this->text()->null(),
            'deadline' => $this->dateTime()->notNull()->comment('срок выполнения задания'),
            'fin_date' => $this->dateTime()->notNull()->comment('фактический срок выполнения задания'),
            'name' => $this->string(128)->notNull(),
            'address' => $this->string(128)->notNull(),
            'budget' => $this->integer()->notNull(),
            'latitude' => $this->string(128)->notNull(),
            'longitude' => $this->string(128)->notNull(),
            'status' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->notNull()->comment('заказчик'),
            'executor_id' => $this->integer()->notNull()->comment('исполнитель'),
            'city_id' => $this->integer()->notNull()->comment('город'),
            'file_link' => $this->string(128)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks}}');
    }
}
