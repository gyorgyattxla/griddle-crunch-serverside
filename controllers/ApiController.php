<?php

namespace app\controllers;

use app\models\Category;
use app\models\Client;
use app\models\Meal;
use app\models\Tag;
use yii\rest\Controller;

class ApiController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
        ];

        return $behaviors;
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

        $request = Yii::$app->request->post();
        $data = $request->getBodyParams();

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
        return ['success' => false, 'errors' => $client->errors];
    }

}
