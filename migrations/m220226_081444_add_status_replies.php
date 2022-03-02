<?php

use yii\db\Migration;

/**
 * Class m220226_081444_add_status_replies
 */
class m220226_081444_add_status_replies extends Migration
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
