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
        $this->addColumn('meal', 'tag_ids', $this->json());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('meal', 'tag_ids');
    }
}
