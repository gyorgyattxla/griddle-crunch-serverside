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
 * @property array|string $tag_ids
 * @property-read Allergen[] $allergenModels
 */
class Meal extends \yii\db\ActiveRecord
{
    public $allergens;
    /**
     * @var array|mixed|null
     */
    public $tags;

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
            [['allergens'], 'safe'],
            [['tag_ids'], 'safe'],
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
            'tag_ids' => 'Címkék',
        ];
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->allergens = $this->getAllergenModels()->select('id')->column();
    }

    public function getAllergenNumber(): array
    {
        return Allergen::find()
            ->select('number')
            ->where(['id' => $this->allergens])
//            ->leftJoin('{{%allergen_to_meal}}', '{{%allergen_to_meal}}.allergen_id = {{%allergen}}.id')
//            ->where (['meal_id' => $this->id])
            ->column();
    }

    public function getTagObjects()
    {
        $tags = $this->getTags()->all();
        if (empty($tags)) {
            return [];
        }
        return $tags;
    }

    public function fields()
    {
        $fields = parent::fields();

        $fields['image'] = function () {
            return $this->image ? Yii::$app->request->hostInfo . Yii::$app->request->baseUrl . '/uploads/' . $this->image : null;
        };

        // címkék nevei tömbben
        $fields['tags'] = function () {
            $tags = $this->getTagObjects();
            return array_map(fn($tag) => $tag->name, $tags);
        };

        $fields['allergens'] = function () {
            return array_map(function ($allergen) {
                return [
                    'id' => $allergen->id,
                    'name' => $allergen->name,
                ];
            }, $this->allergenModels);
        };

        return $fields;
    }


    public function getCategory(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getAllergenModels(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Allergen::class, ['id' => 'allergen_id'])
            ->via('allergenToMeal');
    }

    public function getAllergenToMeal(): \yii\db\ActiveQuery
    {
        return $this->hasMany(AllergenToMeal::class, ['meal_id' => 'id']);
    }

    public function getTags(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_ids']);
    }

}
