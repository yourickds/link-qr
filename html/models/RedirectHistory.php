<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "redirect_history".
 *
 * @property int $id
 * @property int $short_link_id
 * @property string $ip
 * @property string|null $user_agent
 * @property string $created_at
 */
class RedirectHistory extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'redirect_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_agent'], 'default', 'value' => null],
            [['short_link_id', 'ip'], 'required'],
            [['short_link_id'], 'integer'],
            [['created_at'], 'safe'],
            [['ip', 'user_agent'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'short_link_id' => 'Short Link ID',
            'ip' => 'Ip',
            'user_agent' => 'User Agent',
            'created_at' => 'Created At',
        ];
    }

}
