<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use app\models\Category;
use app\models\Product;
use yii\web\HttpException;

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
     * @throws HttpException
     */
    public function actionView( $id ): string
    {
//        Если параметр в экшин не передаём можно прочитать из адресной строки
//        $id = Yii::$app->request->get( 'id' );

        $category = Category::findOne( $id );
        if( empty($category) ) {
            throw new HttpException(404, 'Такой категории в наличии нет.');
        }

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

    /**
     * @return string
     */
    public function actionSearchCategory()
    {
        $queryGet = trim(Yii::$app->request->get('queryGet'));
        $this->setMeta('E-SHOPPER | Поиск ' . $queryGet );
//        if( !$queryGet )
//            return $this->render('search-category');

        $query = Product::find()->where( ['like', 'name', $queryGet] );
        $pages = new Pagination([
            'totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false
        ]);
        $products = $query->offset( $pages->offset )
            ->limit($pages->limit)
            ->all();
        return $this->render('search-category', [
            'products' => $products,
            'pages' => $pages,
            'queryGet' => $queryGet
        ]);
    }
}
