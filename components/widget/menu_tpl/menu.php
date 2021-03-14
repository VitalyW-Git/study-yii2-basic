<?php

use app\components\widget\MenuWidget;
use yii\base\View;
use yii\helpers\Url;

/** @var MenuWidget $category*/
/** @var View */
?>

<li class="panel panel-default">
        <a href="<?= Url::to([ 'category/view', 'id' => $category['id'] ])?>" class="panel-title">
            <?= $category['name'] ?>
            <?php if( isset( $category['childs'] )) : ?>
                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
            <?php endif; ?>
        </a>
    <?php if( isset( $category['childs'] )) : ?>
        <ul class="panel-body">
            <?= $this->getMenuHtml( $category['childs'] ) ?>
        </ul>
    <?php endif; ?>
</li>

