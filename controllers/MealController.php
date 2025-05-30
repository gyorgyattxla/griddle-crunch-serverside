<?php

namespace app\controllers;

use app\models\Meal;
use app\models\Tag;
use app\models\TagToMeal;
use app\models\MealSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AllergenToMeal;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * MealController implements the CRUD actions for Meal model.
 */
class MealController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Meal models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MealSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Meal model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Meal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Meal();

        if ($model->load(Yii::$app->request->post())) {
            $model->tag_ids = Yii::$app->request->post('Meal')['tags'] ?? [];

            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->validate()) {
                if ($model->image) {
                    $filename = uniqid() . '.' . $model->image->extension;
                    $path = Yii::getAlias('@webroot/uploads/') . $filename;
                    if ($model->image->saveAs($path)) {
                        $model->image = $filename;
                    }
                }
                if ($model->save(false)) {
                    // Először töröld a korábbi allergén-kapcsolatokat
                    \app\models\AllergenToMeal::deleteAll(['meal_id' => $model->id]);

                    // Most mentsd el az új allergénkapcsolatokat
                    if (!empty($model->allergens) && is_array($model->allergens)) {
                        foreach ($model->allergens as $allergenId) {
                            $atm = new \app\models\AllergenToMeal();
                            $atm->meal_id = $model->id;
                            $atm->allergen_id = $allergenId;
                            $atm->save(false);
                        }
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Meal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->tags = Yii::$app->request->post('Meal')['tags'] ?? [];

            $imageFile = UploadedFile::getInstance($model, 'image');
            if ($imageFile) {
                $filename = uniqid() . '.' . $imageFile->extension;
                $path = Yii::getAlias('@webroot/uploads/') . $filename;
                if ($imageFile->saveAs($path)) {
                    $model->image = $filename;
                }
            }

            if ($model->save(false)) {

                AllergenToMeal::deleteAll(['meal_id' => $model->id]);

                // Mentsd el az újakat
                if (!empty($model->allergens) && is_array($model->allergens)) {
                    foreach ($model->allergens as $allergenId) {
                        $atm = new AllergenToMeal();
                        $atm->meal_id = $model->id;
                        $atm->allergen_id = $allergenId;
                        $atm->save(false);
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Meal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Meal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Meal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Meal::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreateTagAjax()
    {
        $model = new Tag();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->validate() && $model->save()) {
                return ['success' => true];
            }

            return ['success' => false, 'validationErrors' => ActiveForm::validate($model)];
        }

        return $this->renderAjax('_form_tag', [
            'model' => $model,
        ]);
    }

    public function actionCreateAllergenAjax()
    {
        $model = new \app\models\Allergen();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->validate() && $model->save()) {
                return ['success' => true];
            }

            return ['success' => false, 'validationErrors' => ActiveForm::validate($model)];
        }

        return $this->renderAjax('_form_allergen', [
            'model' => $model,
        ]);
    }

    public function actionTagListJson()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $tags = Tag::find()->orderBy('name')->all();
        $result = [];
        foreach ($tags as $tag) {
            $result[$tag->id] = $tag->name;
        }
        return $result;
    }

    public function actionAllergenListJson()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $allergens = \app\models\Allergen::find()->orderBy('name')->all();
        $result = [];
        foreach ($allergens as $allergen) {
            $result[$allergen->id] = $allergen->name;
        }
        return $result;
    }
}
