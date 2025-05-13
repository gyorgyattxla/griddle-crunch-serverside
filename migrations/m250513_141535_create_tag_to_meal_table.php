<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tag_to_meal}}`.
 */
class m250513_141535_create_tag_to_meal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tag_to_meal}}', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer()->notNull(),
            'meal_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tag_to_meal}}');
    }
}
