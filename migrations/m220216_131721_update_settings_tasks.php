<?php

use yii\db\Migration;

/**
 * Class m220216_131721_update_settings_tasks
 */
class m220216_131721_update_settings_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropColumn('{{%tasks}}', 'deadline');
        $this->dropColumn('{{%tasks}}', 'fin_date');
        $this->dropColumn('{{%tasks}}', 'address');
        $this->dropColumn('{{%tasks}}', 'budget');
        $this->dropColumn('{{%tasks}}', 'latitude');
        $this->dropColumn('{{%tasks}}', 'longitude');
        $this->dropColumn('{{%tasks}}', 'status');
        $this->dropColumn('{{%tasks}}', 'executor_id');
        $this->dropColumn('{{%tasks}}', 'city_id');
        $this->dropColumn('{{%tasks}}', 'file_link');

        $this->addColumn('{{%tasks}}', 'deadline', $this->dateTime()->comment('срок выполнения задания'));
        $this->addColumn('{{%tasks}}', 'fin_date', $this->dateTime()->comment('фактический срок выполнения задания'));
        $this->addColumn('{{%tasks}}', 'address', $this->string(128));
        $this->addColumn('{{%tasks}}', 'budget', $this->integer());
        $this->addColumn('{{%tasks}}', 'latitude', $this->string(128));
        $this->addColumn('{{%tasks}}', 'longitude', $this->string(128));
        $this->addColumn('{{%tasks}}', 'status', $this->string(128));
        $this->addColumn('{{%tasks}}', 'executor_id', $this->integer()->comment('заказчик'));
        $this->addColumn('{{%tasks}}', 'city_id', $this->integer()->comment('город'));
        $this->addColumn('{{%tasks}}', 'file_link', $this->string(128));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks}}');
    }
}
