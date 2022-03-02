<?php

use yii\db\Migration;

/**
 * Class m220228_061908_add_filed_tasks_profiles
 */
class m220228_061908_add_filed_tasks_profiles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%profiles}}', 'filed_tasks', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');
    }
}
