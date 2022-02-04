<?php

use yii\db\Migration;

/**
 * Class m220125_071230_add_primary_key_replies
 */
class m220125_071230_add_primary_key_replies extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%replies}}', 'id', $this->primaryKey());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%replies}}');
    }
}
