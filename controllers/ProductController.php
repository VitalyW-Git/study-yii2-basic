<?php


namespace app\controllers;
use app\models\Product;
use yii\web\HttpException;
use Yii;

class ProductController extends AppController
{

    /**
     * Показываем карточку продукта
     *
     * @param $id
     * @return string
     * @throws HttpException
     */
    public function actionCardProduct( $id )
    {
//        Если параметр в экшин не передаём можно прочитать из адресной строки
//        $id = Yii::$app->request->get( 'id' );
        $product  = Product::findOne( $id );
        if( empty($product) ) {
            throw new HttpException(404, 'Такого продукта нет.');
        }
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