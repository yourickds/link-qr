<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%redirect_history}}`.
 */
class m260330_104201_create_redirect_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%redirect_history}}', [
            'id' => $this->primaryKey(),
            'short_link_id' => $this->integer()->notNull(),
            'ip' => $this->string()->notNull(),
            'user_agent' => $this->string(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%redirect_history}}');
    }
}
