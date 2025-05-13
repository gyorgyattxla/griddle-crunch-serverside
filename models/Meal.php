<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meal".
 *
 * @property int $id
 * @property string $name
 * @property string $ingredients
 * @property int $category_id
 * @property int $price
 */
class Meal extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'ingredients', 'category_id', 'price'], 'required'],
            [['category_id', 'price'], 'integer'],
            [['name'], 'string', 'max' => 191],
            [['ingredients'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'ingredients' => 'Ingredients',
            'category_id' => 'Category ID',
            'price' => 'Price',
        ];
    }

}
