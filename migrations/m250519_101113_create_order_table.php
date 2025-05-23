<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m250519_101113_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->null(),
            'client_name' => $this->string(255)->notNull(),
            'client_address' => $this->string(255)->notNull(),
            'payment_method' => $this->string(50)->notNull(),
            'status' => $this->string()->notNull()->defaultValue('unverified'),
            'order_time' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
        ]);
        $this->addForeignKey('{{%fk-client-id-order-client_id}}','{{%order}}','client_id',
                '{{%client}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-client-id-order-client_id}}', '{{%order}}');
        $this->dropTable('{{%order}}');
    }
}
