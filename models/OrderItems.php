<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $product_id
 * @property string|null $name
 * @property float|null $price
 * @property int|null $qty_item
 * @property float|null $sum_item
 *
 * @property Order $order
 */
class OrderItems extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'order_items';
    }



    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['order_id', 'product_id', 'name', 'price', 'qty_item', 'sum_item'], 'required'],
            [['order_id', 'product_id', 'qty_item'], 'integer'],
            [['price', 'sum_item'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }


    /**
     * @return ActiveQuery
     */
    public function getOrder(): ActiveQuery
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }
}
