<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use Yii;


class CartController extends AppController
{

    /**
     * Добавление товара в корзину
     *
     * @param $id
     * @return false
     */
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        $valueCount = $qty ? $qty : 1;

        $product = Product::findOne($id);
        if (empty($product)) return false;
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $valueCount);
        if ( Yii::$app->request->isAjax ) {
            return $this->redirect( Yii::$app->request->referrer ?: Yii::$app->homeUrl );
        }
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    /**
     * Полностью очищаем корзину
     *
     * @return string
     */
    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    /**
     * Удаление одного товара из корзины
     *
     * @return string
     */
    public function actionRemoveItem()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    /**
     * Просмотр карзины
     *
     * @return string
     */
    public function actionShowBucket()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionArrangeOrder()
    {
        return $this->render('show-bucket');
    }

}