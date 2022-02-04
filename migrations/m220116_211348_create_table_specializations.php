<?php

use yii\db\Migration;

/**
 * Class m220116_211348_create_table_users_specializations
 */
class m220116_211348_create_table_specializations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%specializations}}', [
            'user_id' => $this->integer()->notNull(),
            'specialization_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%specializations}}');
    }
}
