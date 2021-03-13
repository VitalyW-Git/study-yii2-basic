<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m210313_152114_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'patent_id' => $this->integer(),
            'name' => $this->string(255)->notNull(),
            'keywords' => $this->string(255)->null(),
            'description' => $this->string(255)->null(),
        ]);

//        $this->addForeignKey('fk_product_id',
//            'category',
//            'id_product',
//            'product',
//            'id',
//            'cascade',
//            'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
