<?php

use yii\db\Migration;
use yii\db\Schema;

class m170406_183026_create_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%weather}}', [
            'id' => Schema::TYPE_PK,
            'date' => Schema::TYPE_DATE . ' NOT NULL',
            'hour' => Schema::TYPE_INTEGER . ' NOT NULL',
            'temp' => Schema::TYPE_INTEGER . ' NOT NULL',
            'city' => Schema::TYPE_STRING . ' NOT NULL'
        ], $tableOptions);
        $this->createIndex('id', '{{%weather}}', 'id', true);
    }
    public function safeDown()
    {
        $this->dropTable('{{%weather}}');
    }
}
