<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client}}`.
 */
class m250519_100631_create_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(255)->notNull(),
            'lastname' => $this->string(255)->notNull(),
            'auth_key' => $this->string(191)->unique(),
            'password_hash' => $this->string(255)->notNull(),
            'email' => $this->string(191)->notNull()->unique(),
            'address' => $this->string(255)->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
            'updated_at' => $this->timestamp()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client}}');
    }
}
