<?php

namespace app\controllers;

use app\models\ShortLink;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Random\RandomException;
use Yii;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     * @throws RandomException
     * @throws Exception
     */
    public function actionIndex()
    {
        $model = new ShortLink();

        if (Yii::$app->request->isPjax) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->code = bin2hex(random_bytes(3));
                if ($model->save()) {
                    $renderer = new ImageRenderer(
                        new RendererStyle(400),
                        new ImagickImageBackEnd()
                    );
                    $writer = new Writer($renderer);
                    $qrcode = $writer->writeString(Url::to(['redirect/index', 'code' => $model->code], true));
                    $base64 = base64_encode($qrcode);

                    return $this->render('index', [
                        'model' => $model,
                        'code' => $model->code,
                        'img' => "data:image/png;base64, $base64"
                    ]);
                }

            }
        }

        return $this->render('index', ['model' => $model]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
