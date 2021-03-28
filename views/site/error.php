<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error container">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    Доступен сам объект Exception ($exception) через него можно обработать ошибки (statusCode 404, 500 и т. д.)      -->

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
