<?php

use yii\db\Migration;

/**
 * Class m220314_074714_create_table_auth
 */
class m220314_074714_create_table_auth extends Migration
{
    public function up()
    {
        $this->createTable('auth', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'source' => $this->string()->notNull(),
            'source_id' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('auth');
    }
}
