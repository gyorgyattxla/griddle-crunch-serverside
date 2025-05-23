<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%meal}}`.
 */
class m250513_135216_create_meal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%meal}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(191)->notNull()->unique(),
            'ingredients' => $this->string(255)->notNull(),
            'category_id' => $this->integer()->notNull(),
            'image' => $this->string(255),
            'price' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('meal-category_id-category-id', 'meal', 'category_id', 'category', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%meal}}');
    }
}
