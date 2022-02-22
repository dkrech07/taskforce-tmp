<?php

use yii\db\Migration;

/**
 * Class m220222_120609_add_status_replies
 */
class m220222_120609_add_status_replies extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%replies}}', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%replies}}');
    }
}
