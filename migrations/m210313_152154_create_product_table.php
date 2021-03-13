<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m210313_152154_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'name' => $this->string(255)->notNull(),
            'content' => $this->text()->null(),
            'price' => $this->float()->notNull(),
            'keywords' => $this->string(255)->null(),
            'description' => $this->string(255)->null(),
            'img' => $this->string(255)->null(),
            'hit' => "ENUM('0', '1') NOT NULL DEFAULT '0'",
            'new' => "ENUM('0', '1') NOT NULL DEFAULT '0'",
            'sale' => "ENUM('0', '1') NOT NULL DEFAULT '0'",
        ]);

        $this->addForeignKey('fk_category_id',
            'product',
            'category_id',
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
        $this->dropTable('{{%product}}');
    }
}
