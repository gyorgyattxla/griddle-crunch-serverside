<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%allergen_to_meal}}`.
 */
class m250513_135414_create_allergen_to_meal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%allergen_to_meal}}', [
            'allergen_id' => $this->integer()->notNull(),
            'meal_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('allergen-id-allergen_to_meal-allergen_id', 'allergen_to_meal', 'allergen_id', 'allergen', 'id', 'CASCADE' );
        $this->addForeignKey('meal-id-allergen_to_meal-meal_id', 'allergen_to_meal', 'meal_id', 'meal', 'id', 'CASCADE' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%allergen_to_meal}}');
    }
}
