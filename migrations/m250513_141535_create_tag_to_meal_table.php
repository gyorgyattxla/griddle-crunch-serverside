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
            'tag_id' => $this->integer()->notNull(),
            'meal_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('tag-id-tag_to_meal-tag_id', 'tag_to_meal', 'tag_id', 'tag', 'id', 'CASCADE');
        $this->addForeignKey('meal-id-tag_to_meal-meal_id', 'tag_to_meal', 'meal_id', 'meal', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tag_to_meal}}');
    }
}
