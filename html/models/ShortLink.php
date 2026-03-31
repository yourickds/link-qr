<?php

namespace app\models;

use app\validators\AvailabilityUrlValidator;
use Yii;

/**
 * This is the model class for table "short_link".
 *
 * @property int $id
 * @property string $code
 * @property string $url
 * @property int|null $visits
 */
class ShortLink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'short_link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['url'], 'string', 'max' => 255],
            [['url'], 'url', 'defaultScheme' => 'https'],
            [['url'], AvailabilityUrlValidator::class, 'sslVerify' => false],

            [['visits'], 'default', 'value' => 0],
            [['visits'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'url' => 'Url',
            'visits' => 'Visits',
        ];
    }
}
