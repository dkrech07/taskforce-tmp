<?php

use yii\db\Migration;

/**
 * Class m220218_075603_delete_file_link_in_tasks
 */
class m220218_075603_delete_file_link_in_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%tasks}}', 'file_link');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks}}');
    }
}
