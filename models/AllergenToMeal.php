<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "allergen_to_meal".
 *
 * @property int $allergen_id
 * @property int $meal_id
 */
class AllergenToMeal extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'allergen_to_meal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['allergen_id', 'meal_id'], 'required'],
            [['allergen_id', 'meal_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'allergen_id' => 'Allergen ID',
            'meal_id' => 'Meal ID',
        ];
    }

}
