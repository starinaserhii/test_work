<?php

namespace app\controllers;

use app\models\Source;
use app\services\GetSourceService;
use app\services\SetSourceService;
use app\services\UploadUrlService;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * @var UploadUrlService
     */
    private $uploadUrlService;

    /**
     * @var GetSourceService
     */
    private $getSourceService;

    /**
     * @var SetSourceService
     */
    private $setSourceService;

    public function __construct($id, $module, UploadUrlService $uploadUrlService, GetSourceService $getSourceService, SetSourceService $setSourceService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->uploadUrlService = $uploadUrlService;
        $this->getSourceService = $getSourceService;
        $this->setSourceService = $setSourceService;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Source();
        if(Yii::$app->request->isPost ){
            $post = Yii::$app->request->post();
            $this->uploadUrlService->create($post["Source"]);
        }
        $tableObjects = $this->getSourceService->getInfoFromTable();

        return $this->render('index',
            [
                'model' => $model,
                'tableObjects' => $tableObjects
            ]);
    }

    public function actionDownload()
    {
        $token = Yii::$app->request->get('token');
        /**
         * @var Source $modelSource
         */
        $modelSource = $this->getSourceService->getUrl($token);
        if($modelSource === null){
            return $this->redirect('/');
        }
        $this->setSourceService->addCounter($modelSource->id);

        return $this->redirect($modelSource->url);
    }
}
