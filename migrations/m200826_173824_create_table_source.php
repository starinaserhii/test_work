<?php

use yii\db\Migration;

/**
 * Class m200826_173824_create_table_source
 */
class m200826_173824_create_table_source extends Migration
{
    const TABLE_NAME = 'source';
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'id_url' => $this->integer()->unsigned()->notNull()->comment('Иденитификатор url'),
            'token_url' => $this->string(50)->notNull()->comment('Token ссылки'),
            'datetime_life' => $this->dateTime()->notNull()->comment('Время окончания жизни url'),
            'counter' => $this->integer()->unsigned()->defaultValue(0)->notNull()->comment('Количество использований короткого url')
        ]);
        $this->createIndex(
            'ix__source__id_url',
            static::TABLE_NAME,
            'id_url'
        );
        $this->createIndex(
            'ix__source__token_url_datetime_life',
            static::TABLE_NAME,
            ['token_url', 'datetime_life']
        );
        $this->addForeignKey(
            'fk_source_type_id_url__url__id',
            self::TABLE_NAME,
            'id_url',
            'url',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addCommentOnTable(
            static::TABLE_NAME,
            'Главная таблица записей с короткими токенами'
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
