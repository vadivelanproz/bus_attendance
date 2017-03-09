<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property integer $log_id
 * @property integer $bus_id
 * @property string $timestamp
 * @property string $dir
 *
 * @property BusDetails $bus
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rf_id'], 'required'],
            [['rf_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['bus_no'], 'integer'],
            [['dir'], 'string', 'max' => 25],
            [['rf_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusDetails::className(), 'targetAttribute' => ['rf_id' => 'rf_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'rf_id' => 'RF ID',
            'timestamp' => 'Time',
            'dir' => 'Dir',
            'log_date'=>'Date',
            'bus_no'=>'Bus No'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBus()
    {
        return $this->hasOne(BusDetails::className(), ['rf_id' => 'rf_id']);
    }
}
