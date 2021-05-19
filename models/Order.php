<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;


/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $qty
 * @property float|null $sum
 * @property int|null $status
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 *
 * @property OrderItems[] $order_item
 */
class Order extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'order';
    }

    public function behaviors()
    {
        return [
            [
                // данный класс заполняет указонные поля меткой времени
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    // перед вставкой новой записи
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    // перед обновлением записи
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'email', 'phone', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty'], 'integer'],
            [['sum'], 'number'],
            [['status'], 'boolean'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адресс',
        ];
    }


    public function getOrderItems()
    {
        $this->hasMany(OrderItems::class, ['order_id' => 'id']);
    }
}
