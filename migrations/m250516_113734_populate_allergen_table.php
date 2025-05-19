<?php

use yii\db\Migration;

class m250516_113734_populate_allergen_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('allergen', ['number', 'name'], [
            [1, 'Glutén'],
            [2, 'Rákfélék'],
            [3, 'Tojás'],
            [4, 'Hal'],
            [5, 'Földimogyoró'],
            [6, 'Szója'],
            [7, 'Laktóz'],
            [8, 'Diófélék'],
            [9, 'Zeller'],
            [10, 'Mustár'],
            [11, 'Szezámmag'],
            [12, 'Szulfitok'],
            [13, 'Csillagfürt'],
            [14, 'Puhatestűek'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('allergen', ['number' => [
            1,2,3,4,5,6,7,8,9,10,11,12,13,14
        ]]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250516_113734_populate_allergen_table cannot be reverted.\n";

        return false;
    }
    */
}
