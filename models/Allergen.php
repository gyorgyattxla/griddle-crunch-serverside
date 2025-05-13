<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "allergen".
 *
 * @property int $id
 * @property int $number
 * @property string $name
 */
class Allergen extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'allergen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'name'], 'required'],
            [['number'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['number'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'name' => 'Name',
        ];
    }

}
