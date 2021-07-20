<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$items = $model->orderItems;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);

?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            'status',
            'name',
            'email:email',
            'phone',
            'address',

        ],
    ]) ?>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Cумма</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><a href="<?= Url::to(['/product/card-product', 'id' => $item->id]) ?>"><?= $item['name'] ?></a></td>
                    <td><?= $item->qty_item ?> шт</td>
                    <td><?= $item->price ?> руб.</td>
                    <td><?= $item->sum_item ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>


</div>
