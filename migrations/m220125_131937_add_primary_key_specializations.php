<?php

use yii\db\Migration;

/**
 * Class m220125_131937_add_primary_key_specializations
 */
class m220125_131937_add_primary_key_specializations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%specializations}}', 'id', $this->primaryKey());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%specializations}}');
    }
}
