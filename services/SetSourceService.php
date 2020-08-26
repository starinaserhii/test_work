<?php
declare(strict_types=1);

namespace app\services;


use app\models\Source;

class SetSourceService
{
    public function addCounter(int $id)
    {
        $post = Source::findOne($id);

        $post->updateCounters(['counter' => 1]);
    }
}