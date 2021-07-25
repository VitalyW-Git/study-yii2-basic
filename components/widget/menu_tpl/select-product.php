<?php
/** Вложенный селект для страницы редактирования product */

use app\components\widget\MenuWidget;
use yii\base\View;

/** @var MenuWidget $category*/
/** @var MenuWidget $tab*/
/** @var View */
?>

<option
    value="<?= $category['id'] ?>"
    <?php if ($category['id'] == $this->model->category_id) echo ' selected' ?>
>
        <?= $tab . $category['name'] ?>
</option>

<?php if( isset( $category['childs'] )) : ?>
    <ul class="panel-collapse collapse in">
        <?= $this->getMenuHtml( $category['childs'], $tab . '<span>-</span>' ) ?>
    </ul>
<?php endif; ?>


