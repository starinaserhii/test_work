<?php
declare(strict_types=1);

namespace app\services;

use app\helpers\TokenHelper;
use app\models\Source;
use app\models\Url;

class UploadUrlService
{
    /**
     *  Сохранение новой ссылки
     * @param array $form - массив из формы
     * @return string|null
     */
    public function create(array $form): ?string
    {
        $modelUrl = new Url();
        $modelUrl->url = $form['url'];
        if(!$modelUrl->save()){
            return null;
        }
        $modelSource = new Source();
        $modelSource->id_url = (int)$modelUrl->id;
        $modelSource->datetime_life = date('Y-m-d H:i:s', strtotime($form['datetime_life']));
        $modelSource->token_url = TokenHelper::generateString();
        $modelSource->validate();

        if($modelSource->save()){
            return $modelSource->token_url;
        }
        return null;
    }
}