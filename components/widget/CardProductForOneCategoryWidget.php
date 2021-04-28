<?php

namespace app\components\widget;

use app\models\Category;
use app\models\Product;
use yii\base\Widget;
use yii\data\Pagination;

class CardProductForOneCategoryWidget extends Widget
{
    /** @var Product[] $products */
    public $products;
    /** @var Category $category */
    public $category;
    /** @var Pagination $pages */
    public $pages;

    public function run()
    {
        return $this->render('card-product-for-one-category', [
            'products' => $this->products,
            'category' => $this->category,
            'pages' => $this->pages,
        ]);
    }
}