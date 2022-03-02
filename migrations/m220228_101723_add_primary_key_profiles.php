<?php

use yii\db\Migration;

/**
 * Class m220228_101723_add_primary_key_profiles
 */
class m220228_101723_add_primary_key_profiles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%profiles}}', 'id', $this->primaryKey());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');
    }
}
