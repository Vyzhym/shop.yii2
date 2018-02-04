<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 04.02.2018
 * Time: 14:36
 */

namespace app\models;
use yii\db\ActiveRecord;


class Category extends ActiveRecord
{

    public static function tableName()
    {
        return 'category';
    }

    public function getProduct()
    {
        return $this->hasMany(Product::className(),['category_id' => 'id']);

    }


} 