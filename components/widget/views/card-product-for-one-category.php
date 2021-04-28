<?php

use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var Product[] $products */
/** @var Pagination $pages */
/** @var Category $category */
?>



<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center"><?= $category->name ?> Items</h2>
        <?php if( !empty($products) ) { ?>
            <?php
            /** @var Product $product */
            foreach ( $products as $product ) { ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <?= Html::img("@web/images/products/{$product->img}", ['alt' => $product->name])?>
                                <h2>$<?= $product->price ?></h2>
                                <p><?= mb_strimwidth($product->name, 0, 15); ?></p>
                                <!--                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>-->
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>$<?= $product->price ?></h2>
                                    <p><?= $product->name ?></p>
                                    <a href="<?= Url::to( ['product/card-product', 'id' => $product->id] )?>" target="_blank"
                                       class="btn btn-default add-to-cart"><i class="glyphicon glyphicon-eye-open"></i>
                                        View product
                                    </a>
                                    <a href="#" data-id-product="<?= $product->id ?>"
                                       class="btn btn-default add-to-cart add-to-cart-bucket">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                            <?php if ($product->new) : ?>
                                <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка', 'class' => "new"])?>
                            <?php endif; ?>
                            <?php if ($product->sale) : ?>
                                <?= Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class' => "new"])?>
                            <?php endif; ?>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <h2>Здесь товаров пока нет</h2>
        <?php } ?>
        <?= // отображаем ссылки на страницы
        LinkPager::widget([
              'pagination' => $pages,
          ]);?>
    </div><!--features_items-->
</div>
