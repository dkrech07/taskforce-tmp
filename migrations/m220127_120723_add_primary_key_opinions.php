<?php

use yii\db\Migration;

/**
 * Class m220127_120723_add_primary_key_opinions
 */
class m220127_120723_add_primary_key_opinions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%opinions}}', 'id', $this->primaryKey());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%opinions}}');
    }
}
