<?php

use yii\bootstrap\Modal;



/**
 * Модалка карзины
 */

Modal::begin([
    'header' => '<h2>Корзина</h2>',
    'id' => 'cart',
    'size' => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
        <button type="button" class="btn btn-success">Оформить заказ</button>
        <button type="button" class="btn btn-danger js-btn-clear">Очистить корзину</button>'
    ]);
Modal::end();

