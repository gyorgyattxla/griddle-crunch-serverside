<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%open_hours}}`.
 */
class m250513_135520_create_open_hours_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%open_hours}}', [
            'id' => $this->primaryKey(),
            'day_name' => $this->string(255)->notNull(),
            'open_time' => $this->string()->notNull(),
            'close_time' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%open_hours}}');
    }
}
