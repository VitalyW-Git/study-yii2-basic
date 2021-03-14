<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;

class CategoryController extends AppController
{

    /**
     * Вывод карточек product на главной странице
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $products = Product::find()
            ->where(['hit' => Product::HIT_PRODUCT])
            ->limit(6)
            ->all();
        return $this->render('index', ['products' => $products]);
    }

    /**
     * Вывод карточек товара для одной категории
     *
     * @param Category $id
     * @return string
     */
    public function actionView( $id ): string
    {
        $id = Yii::$app->request->get( 'id' );
        $products = Product::find()
            ->where(['category_id' => $id])
            ->all();
        return $this->render('view', ['products' => $products]);
    }
}
