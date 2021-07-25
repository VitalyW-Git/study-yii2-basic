<?php

use app\components\widget\MenuWidget;
use app\modules\admin\models\Product;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">


    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'category_id')->textInput() ?>

    <div class="form-group field-category-parent_id has-success">
        <label class="control-label" for="product-category_id">Родительская категория</label>
        <select id="product-category_id" class="form-control" name="Product[category_id]" >
            <?= MenuWidget::widget(['template' => 'select-product', 'model' => $model])?>
        </select>

        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php
    // текстовы редактор
    // php composer.phar require --prefer-dist mihaildev/yii2-ckeditor "*"
    /*echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
        ],
    ]); */
    // текстовый редактор с подгрузкой изображений
    // php composer.phar require --prefer-dist mihaildev/yii2-elfinder "*"
        echo $form->field($model, 'content')->widget(CKEditor::class, [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[

            ]),
        ]);
    ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hit')->dropDownList(Product::getParamsForSelect(), ['prompt' => '']) ?>

    <?= $form->field($model, 'new')->dropDownList(Product::getParamsForSelect(), ['prompt' => '']) ?>

    <?= $form->field($model, 'sale')->dropDownList(Product::getParamsForSelect(), ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
