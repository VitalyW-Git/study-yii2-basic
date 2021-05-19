<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var Order $order */
/** @var $session */
?>

<div class="container">
    <?php if (!empty($session['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Cумма</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($session['cart'] as $id => $item): ?>
                    <tr>
                        <td>
                            <?= Html::img("@web/images/products/{$item['img']}",
                                ['alt' => $item['name'], 'height' => 50]) ?>
                        </td>
                        <td><a href="<?= Url::to(['product/card-product', 'id' => $id]) ?>"><?= $item['name'] ?></a></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['price'] * $item['qty'] ?></td>
                        <td><span data-id-item-bucket="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item"
                                  aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="4">Итого:</td>
                    <td><?= $session['cart.qty'] ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4">На сумму:</td>
                    <td><?= $session['cart.sum'] ?></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <?php $form = ActiveForm::begin() ?>

            <?= $form->field($order, 'name') ?>
            <?= $form->field($order, 'email') ?>
            <?= $form->field($order, 'phone') ?>
            <?= $form->field($order, 'address') ?>

            <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>

        <?php $form = ActiveForm::end() ?>
    <?php else: ?>
        <h3>Корзина пуста</h3>
    <?php endif; ?>
</div>
