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
            'price' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%meal}}');
    }
}
