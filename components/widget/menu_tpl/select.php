<?php

use app\components\widget\MenuWidget;
use yii\base\View;

/** @var MenuWidget $category*/
/** @var View */
?>
++++
<li class="panel panel-default">
    <a href="" class="panel-title">
        <?= $category['name'] ?>
        <?php if( isset( $category['childs'] )) : ?>
            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
        <?php endif; ?>
    </a>
    <?php if( isset( $category['childs'] )) : ?>
        <ul class="panel-collapse collapse in">
            <?= $this->getMenuHtml( $category['childs'] ) ?>
        </ul>
    <?php endif; ?>
</li>

