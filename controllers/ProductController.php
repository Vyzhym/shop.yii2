<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.03.2018
 * Time: 13:59
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\web\HttpException;

class ProductController extends AppController
{
    public function actionView($id){
        $id = Yii::$app->request->get('id');
       // $product = Product::findOne($id);
        //ленивая загрузка
        $product = Product::find()->with('category')->where(['id'=>$id])->limit(1)->one();
        if(empty($product))
            throw new HttpException(404, 'Такого продукта не существует');


        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E-SHOPPER | ' . $product->name, $product->keywords, $product->description);

        return $this->render('view',compact('product','hits'));
    }

}