<?php

use yii\db\Migration;

class m171024_051247_step_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%step}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'order' => $this->integer(),
            'image' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
        ]);

        $this->createIndex('idx-step-post_id', '{{%step}}', ['post_id','order']);

        $this->addForeignKey('fk-step-post', '{{%step}}', 'post_id', '{{%post}}', 'id', 'SET NULL', 'CASCADE');


    }

    public function safeDown()
    {
        $this->dropTable('{{%step}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171024_051247_post_step_table cannot be reverted.\n";

        return false;
    }
    */
}
