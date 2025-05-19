<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property int $order_id
 * @property int $meal_id
 * @property int $quantity
 * @property int $price
 */
class OrderItems extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'meal_id', 'quantity', 'price'], 'required'],
            [['order_id', 'meal_id', 'quantity', 'price'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'meal_id' => 'Meal ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
        ];
    }

}
