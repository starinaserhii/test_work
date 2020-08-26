<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "source".
 *
 * @property int $id
 * @property int $id_url Иденитификатор url
 * @property string $token_url Token ссылки
 * @property string $datetime_life Время окончания жизни url
 * @property int $counter Количество использований короткого url
 *
 * @property Url $url
 */
class Source extends \yii\db\ActiveRecord
{
    public $url;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'source';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_url', 'datetime_life'], 'required'],
            [['id_url', 'counter'], 'integer'],
            [['counter'], 'default', 'value' => 0],
            [['datetime_life'], 'safe'],
            [['token_url'], 'string', 'max' => 50],
            [['id_url'], 'exist', 'skipOnError' => true, 'targetClass' => Url::className(), 'targetAttribute' => ['id_url' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_url' => 'Id Url',
            'token_url' => 'Token Url',
            'datetime_life' => 'Datetime Life',
            'counter' => 'Counter',
        ];
    }

    /**
     * Gets query for [[Url]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUrl()
    {
        return $this->hasOne(Url::className(), ['id' => 'id_url']);
    }
}
