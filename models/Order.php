<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $client_id
 * @property string $client_name
 * @property string $client_address
 * @property string $payment_method
 * @property string $status
 * @property string $order_time
 */
class Order extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 'unverified'],
            [['client_id', 'client_name', 'client_address', 'payment_method', 'order_time'], 'required'],
            [['client_id'], 'integer'],
            [['order_time'], 'safe'],
            [['client_name', 'client_address', 'status'], 'string', 'max' => 255],
            [['payment_method'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'client_name' => 'Client Name',
            'client_address' => 'Client Address',
            'payment_method' => 'Payment Method',
            'status' => 'Status',
            'order_time' => 'Order Time',
        ];
    }

}
