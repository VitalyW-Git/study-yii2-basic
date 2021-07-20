<?php
/** Вложенные категории селекта для страницы админки, редактирование категории */

use app\components\widget\MenuWidget;
use yii\base\View;

/** @var MenuWidget $category*/
/** @var MenuWidget $tab*/
/** @var View */
?>

<option
    value="<?= $category['id'] ?>"
    <?php if ($category['id'] == $this->model->parent_id) echo ' selected' ?>
    <?php if ($category['id'] == $this->model->id) echo ' disabled="disabled"' ?>
>
        <?= $tab . $category['name'] ?>
</option>

<?php if( isset( $category['childs'] )) : ?>
    <ul class="panel-collapse collapse in">
        <?= $this->getMenuHtml( $category['childs'], $tab . '<span>-</span>' ) ?>
    </ul>
<?php endif; ?>


