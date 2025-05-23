<?php

use yii\db\Migration;

class m250523_101721_populate_open_hours_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('open_hours', ['day_name', 'open_time', 'close_time'], [
           ['Hétfő', '08:00', '20:00'],
           ['Kedd', '08:00', '20:00'],
           ['Szerda', '08:00', '20:00'],
           ['Csütörtök', '08:00', '20:00'],
           ['Péntek', '08:00', '22:00'],
           ['Szombat', '10:00', '22:00'],
           ['Vasárnap', '10:00', '18:00'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250523_101721_populate_open_hours_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250523_101721_populate_open_hours_table cannot be reverted.\n";

        return false;
    }
    */
}
