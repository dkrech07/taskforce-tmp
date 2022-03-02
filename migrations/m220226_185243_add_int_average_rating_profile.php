<?php

use yii\db\Migration;

/**
 * Class m220226_185243_add_int_average_rating_profile
 */
class m220226_185243_add_int_average_rating_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%profiles}}', 'average_rating');
        $this->addColumn('{{%profiles}}', 'average_rating', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');
    }
}
