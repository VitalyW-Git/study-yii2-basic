<?php


namespace app\controllers;
use app\models\Product;
use Yii;

class ProductController extends AppController
{

    public function actionCardProduct( $id )
    {
        $id = Yii::$app->request->get('id');
        $product  = Product::findOne( $id );
//        $product = Product::find()->where('category')->where( ['id' => $id] ); // жадная загрузка
        $products = Product::find()
            ->where(['hit' => Product::HIT_PRODUCT])
            ->limit(6)
            ->all();
        $this->setMeta('E-SHOPPER | ' . $product->name, $product->keywords, $product->description );

        return $this->render('card-product', [
            'product' => $product,
            'products' => $products
        ]);
    }
}