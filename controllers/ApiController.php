<?php

namespace app\controllers;

use app\models\Category;
use app\models\Client;
use app\models\Meal;
use app\models\Order;
use app\models\OrderItems;
use app\models\Tag;
use Yii;
use yii\filters\Cors;
use yii\rest\Controller;


class ApiController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                // Allow requests from localhost:8100
                'Origin' => ['http://localhost:8100'],  // Change this if necessary
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,  // Cache preflight response for 24 hours
                // Optionally, if you need custom headers
                'Access-Control-Request-Headers' => ['x-custom-header', 'Content-Type', 'Authorization'],
                'Access-Control-Allow-Headers' => ['Content-Type', 'Authorization'], // Add more if needed
                'Access-Control-Allow-Origin' => ['*'], // Use '*' to allow any origin, or use specific origins
            ],
        ];

        return $behaviors;
    }

    public function actions()
    {
        return [
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }


    public function actionGetAllMeals() : array {
        return Meal::find()->asArray()->all();
    }

    public function actionGetMealsByCategory($category_id) : array {
        return Meal::find()->asArray()->where(['category_id' => $category_id])->all();
    }

    public function actionGetMeal($id){
        return Meal::findOne($id);
    }

    public function actionGetMealTags($id){
        return Tag::find()->asArray()->where(['meal_id' => $id])->all();
    }

    public function actionGetAllCategories() : array {
        return Category::find()->asArray()->all();
    }

    public function actionRegister() {

        //$request = Yii::$app->request->post();
        $data = Yii::$app->request->rawBody;
        $data = json_decode($data, true);

        $client = new Client();
        $client->firstname = $data['firstname'] ?? null;
        $client->lastname = $data['lastname'] ?? null;
        $client->email = $data['email'] ?? null;
        $client->address = null;
        $client->setPassword($data['password'] ?? '');
        $client->generateAuthKey();

        if ($client->validate() && $client->save()) {
            return ['success' => true, 'message' => 'Client registered successfully.'];
        }

        Yii::$app->response->statusCode = 400;
        return ['success' => false, 'message' => $data];
    }

    public function actionLogin() {
        $data = Yii::$app->request->rawBody;
        $data = json_decode($data, true);

        if (empty($data['email']) || empty($data['password'])) {
            Yii::$app->response->statusCode = 400; // Bad request
            return ['success' => false, 'message' => 'Email és jelszó szükséges.'];
        }

        $client = Client::findOne(['email' => $data['email']]);

        if (!$client || !Yii::$app->security->validatePassword($data['password'], $client->password_hash)) {
            Yii::$app->response->statusCode = 401;
            return ['success' => false, 'message' => 'Hibás email vagy jelszó.'];
        }

        return [
            'success' => true,
            'message' => 'Sikeres bejelentkezés.',
            'client' => [
                'id' => $client->id,
                'email' => $client->email
            ]
        ];

    }

    public function actionSaveOrder() {
        $data = Yii::$app->request->rawBody;
        $data = json_decode($data, true);

        $order = new Order();
        $order->client_id = $data['client_id'] ?? null;
        $order->client_name = $data['client_name'];
        $order->client_address = $data['client_address'];
        $order->payment_method = $data['payment_method'];
        $order->save();

        foreach ($data['meals'] as $meal) {
            $orderItem = new OrderItems;
            $orderItem->order_id = $order->id;
            $orderItem->meal_id = $meal['id'];
            $orderItem->price = $meal['price'];
            $orderItem->quantity = $meal['quantity'];
            $orderItem->save();
        }
    }

    public function actionViewOrder($order_id)
    {

        $order = Order::findOne($order_id);

        if (!$order) {
            return ['error' => 'Order not found'];
        }

        return [
            'order_id' => $order->id,
            'client_address' => $order->client_address,
            'status' => $order->status,
        ];
    }

}
