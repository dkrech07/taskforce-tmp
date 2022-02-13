<?php

use yii\db\Migration;

/**
 * Class m220208_121513_add_foreign_key_profiles
 */
class m220208_121513_add_foreign_key_profiles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%profiles}}', 'user_id');
        $this->addColumn('{{%profiles}}', 'user_id', $this->integer()->notNull());
        $this->addForeignKey(
            'user_id',
            'profiles',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');
    }
}
