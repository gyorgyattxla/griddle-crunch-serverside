<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "open_hours".
 *
 * @property int $id
 * @property string $day_name
 * @property string $open_time
 * @property string $close_time
 */
class OpenHours extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'open_hours';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day_name', 'open_time', 'close_time'], 'required'],
            [['day_name', 'open_time', 'close_time'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day_name' => 'Day Name',
            'open_time' => 'Open Time',
            'close_time' => 'Close Time',
        ];
    }

}
