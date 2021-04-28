<?php

namespace app\components\widget;

use app\models\Product;
use yii\base\Widget;

class CardProductForMainPageWidget extends Widget
{
    /** @var Product[] $products */
    public $products;

    public function run()
    {
        return $this->render('card-product-for-main-page', [
            'products' => $this->products
        ]);
    }

}