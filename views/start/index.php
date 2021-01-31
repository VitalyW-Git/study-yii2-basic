<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h2>Переключение шаблона index</h2>

<?php if ( Yii::$app->session->hasFlash('success') ) : ?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <?php echo Yii::$app->session->getFlash('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="alert alert-primary" role="alert">
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<? endif; ?>
<?php if ( Yii::$app->session->hasFlash('error') ) : ?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <?php echo Yii::$app->session->getFlash('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="alert alert-primary" role="alert">
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<? endif; ?>

<!-- массив переданного обекта TestForm -->
<!-- var_dump( $model ); -->
<!-- изменеие самого шаблона формы можно с помощью $template, добавление class и изменение id -->
<?php $form = ActiveForm::begin(['options' => ['id' => 'testForm', 'class' => 'form-horizontal'] ]); ?>

<?//= $form->field($model, 'name')->label('Пароль')->passwordInput(); ?>
<?= $form->field($model, 'name')->label('Имя')->textInput()->hint('Пожалуйста, введите имя'); ?>
<?= $form->field($model, 'email')->input('email'); ?>
<?= $form->field($model, 'text')->label('Текст Собщения')->textarea(['rows' => 5]); ?>

<?= Html::submitButton( 'Отправить', ['class' => 'btn btn-success'] ) ?>

<?php $form = ActiveForm::end(); ?>