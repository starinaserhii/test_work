<?php

use yii\db\Migration;

/**
 * Class m200826_175342_create_table_url
 */
class m200826_172342_create_table_url extends Migration
{
    const TABLE_NAME = 'url';
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'url' => $this->string(1000)->unsigned()->notNull()->comment('Иденитификатор url')
        ]);

        $this->addCommentOnTable(
            static::TABLE_NAME,
            'Ссылка клиента'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
