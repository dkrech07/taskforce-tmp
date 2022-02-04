<?php

use yii\db\Migration;

/**
 * Class m220128_070018_add_float_average_rating_profile
 */
class m220128_070018_add_float_average_rating_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%profiles}}', 'average_rating');
        $this->addColumn('{{%profiles}}', 'average_rating', $this->float()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');
    }
}
