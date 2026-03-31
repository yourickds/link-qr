<?php

namespace app\validators;

use Yii;
use yii\validators\Validator;

class AvailabilityUrlValidator extends Validator
{
    /**
     * @var array массив кодов HTTP, которые считаются успешными. По умолчанию [200].
     */
    public $httpStatusCodes = [200];
    /**
     * @var int время ожидания ответа в секундах. По умолчанию 5.
     */
    public $timeout = 5;
    /**
     * @var bool проверять SSL-сертификаты при запросе. По умолчанию true.
     */
    public $sslVerify = true;


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', 'Данный URL не доступен');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function validateValue($value)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $value);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, (int)$this->sslVerify);
            curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if (!in_array($httpCode, $this->httpStatusCodes)) {
                return [$this->message, []];
            }
        } catch (\Exception $e) {
            Yii::error("Ошибка проверки URL: {$e->getMessage()}");
            return ['Произошла ошибка! Повторите запрос позднее.', []];
        }

        return null;
    }
}
