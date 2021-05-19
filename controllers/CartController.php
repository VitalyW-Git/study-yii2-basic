<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;
use app\models\Product;
use Yii;


class CartController extends AppController
{

    /**
     * Добавление товара в корзину
     *
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

    /**
     * Оформление заказа, запись данных
     *
     * @return string
     */
    public function actionArrangeOrder()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->setMeta('Корзина');
        $order = new Order;
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ успешно оформлен!');
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при оформлении!');
            }
        }
        return $this->render('show-bucket', [
            'session' => $session,
            'order' => $order
        ]);
    }

    /**
     * Заполняем данные при оформленном заказе
     *
     * @param $items
     * @param $orderId
     */
    protected function saveOrderItems($items, $orderId)
    {
        foreach ($items as $id => $item){
            $orderItems = new OrderItems();
            $orderItems->order_id = $orderId;
            $orderItems->product_id = $id;
            $orderItems->name = $item['name'];
            $orderItems->price = $item['price'];
            $orderItems->qty_item = $item['qty'];
            $orderItems->sum_item = $item['qty'] * $item['price'];
            $orderItems->save();
        }
    }

}