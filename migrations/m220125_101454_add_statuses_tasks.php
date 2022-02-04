<?php

use yii\db\Migration;

/**
 * Class m220125_101454_add_statuses_tasks
 */
class m220125_101454_add_statuses_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%tasks}}', 'status');
        $this->addColumn('{{%tasks}}', 'status', $this->string(128)->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks}}');
    }
}
