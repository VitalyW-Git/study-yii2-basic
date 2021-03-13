<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_product}}`.
 */
class m210313_200832_create_category_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_product}}', [
            'id' => $this->primaryKey(),
            'id_product' => $this->integer(),
            'id_category' => $this->integer(),
        ]);

        $this->addForeignKey('fk_product_id',
            'category_product',
            'id_product',
            'product',
            'id',
            'cascade',
            'cascade');

        $this->addForeignKey('fk_category_id',
            'category_product',
            'id_category',
            'category',
            'id',
            'cascade',
            'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category_product}}');
    }
}
