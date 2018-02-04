<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 04.02.2018
 * Time: 14:36
 */

namespace app\models;
use yii\db\ActiveRecord;


class Product extends ActiveRecord
{

    public static function tableName()
    {
        return 'product';
    }

    public function getCategory()
    {
        return $this->hasMany(Category::className(),['id' => 'category_id']);

    }


} 