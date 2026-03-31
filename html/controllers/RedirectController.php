<?php

namespace app\controllers;

use app\models\RedirectHistory;
use app\models\ShortLink;
use Yii;
use yii\web\NotFoundHttpException;

class RedirectController extends \yii\web\Controller
{
    public function actionIndex($code)
    {
        $model = $this->findModel($code);

        $model->visits++;
        $model->save();

        $historyModel = new RedirectHistory();
        $historyModel->short_link_id = $model->id;
        $historyModel->ip = Yii::$app->request->userIP;
        $historyModel->user_agent = Yii::$app->request->userAgent;
        $historyModel->save();

        return $this->redirect($model->url);
    }

    /**
     * Finds the ShortLink model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $code code
     * @return ShortLink the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($code)
    {
        if (($model = ShortLink::findOne(['code' => $code])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
