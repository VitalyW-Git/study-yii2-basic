<?php

namespace app\controllers;

use yii\data\Pagination;
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
        $this->setMeta('E-SHOPPER');
        return $this->render('index', ['products' => $products]);
    }

    /**
     * Вывод карточек товара для одной категории
     *
     * @param $id
     * @return string
     */
    public function actionView( $id ): string
    {
        $id = Yii::$app->request->get( 'id' );

        $query = Product::find()->where( ['category_id' => $id] );
        $pages = new Pagination([
            'totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false
        ]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $category = Category::findOne( $id );
        $this->setMeta('E-SHOPPER | ' . $category->name, $category->keywords, $category->description );

        return $this->render('view', [
            'products' => $products,
            'pages' => $pages,
            'category' => $category
        ] );
    }
}
