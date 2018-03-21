<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.03.2018
 * Time: 14:10
 */

namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use Yii;

class CartController extends AppController
{
    public function actionAdd()
    {
$id = Yii::$app->request->get('id');
$product = Product::findOne($id);
if(empty($product)) return false;
debug($product);
    }
}