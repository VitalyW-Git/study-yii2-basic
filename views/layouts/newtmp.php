<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset; // подключение script/style/библиотек/плагинов
use yii\helpers\Html;
AppAsset::register($this);

/*  $this->head() $this->beginPage() $this->beginBody() $this->beginPage()
 *  метки с помощью которых указываем позицию в блоке подключения
 */
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <div class="container">
        <ul class="nav nav-pills">
            <li class="nav-item">
<!--                <a class="nav-link active" aria-current="page" href="#">Active</a>-->
                <?= Html::a('Главная', '/web/') ?>
            </li>
            <li class="nav-item">
<!--                <a class="nav-link" href="#">Link</a>-->
                <?= Html::a('Статьи', ['/start/index/']) ?>
            </li>
            <li class="nav-item">
<!--                <a class="nav-link" href="#">Link</a>-->
                <?= Html::a('Статья', ['/start/show/']) ?>
            </li>
        </ul>
        <?= $content ?>
    </div>
</div>

<!--подключение страницы show /web/index.php?r=start/show-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>