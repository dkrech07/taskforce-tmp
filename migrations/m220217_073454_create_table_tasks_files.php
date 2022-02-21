<?php

use yii\db\Migration;

/**
 * Class m220217_073454_create_table_tasks_files
 */
class m220217_073454_create_table_tasks_files extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks_files}}', [
            'task_id' => $this->integer(),
            'link' => $this->text(),
        ]);

        $this->addForeignKey(
            'task_id',
            'tasks_files',
            'task_id',
            'tasks',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks_files}}');
    }
}
