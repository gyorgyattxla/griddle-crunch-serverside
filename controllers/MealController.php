<?php

namespace app\controllers;

use app\models\Meal;
use app\models\TagToMeal;
use app\models\MealSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AllergenToMeal;
use yii\web\UploadedFile;

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
                    // Allergén kapcsolatok mentése
                    if (!empty($model->allergens)) {
                        foreach ($model->allergens as $allergenId) {
                            $relation = new AllergenToMeal();
                            $relation->meal_id = $model->id;
                            $relation->allergen_id = $allergenId;
                            $relation->save();
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
            $imageFile = UploadedFile::getInstance($model, 'image');
            if ($imageFile) {
                $filename = uniqid() . '.' . $imageFile->extension;
                $path = Yii::getAlias('@webroot/uploads/') . $filename;
                if ($imageFile->saveAs($path)) {
                    $model->image = $filename;
                }
            }

            if ($model->save(false)) {
                // Régi kapcsolatok törlése
                AllergenToMeal::deleteAll(['meal_id' => $model->id]);

                // Új kapcsolatok mentése
                if (!empty($model->allergens)) {
                    foreach ($model->allergens as $allergenId) {
                        $relation = new AllergenToMeal();
                        $relation->meal_id = $model->id;
                        $relation->allergen_id = $allergenId;
                        $relation->save();
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
}
