<?php
declare(strict_types=1);

namespace app\services;


use app\models\Source;
use app\models\Url;
use yii\db\ActiveRecord;

class GetSourceService
{

    /**
     *  Получение информации для загрузки таблицы всех записей
     * @return array|ActiveRecord[]
     */
    public function getInfoFromTable(): array
    {
        return Source::find()
            ->select(['url' => 'u.url', 's.counter', 's.token_url'])
            ->alias('s')
            ->innerJoin(['u' => Url::tableName()], 's.id_url = u.id')
            ->all();
    }

    /**
     *  Проверка и получение активного url
     * @param string $token - токен короткой ссылки
     * @return ActiveRecord|null
     */
    public function getUrl(string $token): ?ActiveRecord
    {
        $dateTimeNow = date('Y-m-d H-i-s');

        return Source::find()
            ->select(['url' => 'u.url', 's.id'])
            ->alias('s')
            ->innerJoin(['u' => Url::tableName()], 's.id_url = u.id')
            ->where(['s.token_url' => $token])
            ->andWhere(['>', 's.datetime_life', $dateTimeNow])
            ->one();
    }
}