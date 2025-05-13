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
            'name' => $this->string(255)->notNull(),
            'time' => $this->integer()->notNull()->comment('Éjfél után eltelt percek'),
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
