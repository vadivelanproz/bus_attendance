<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log_out".
 *
 * @property integer $log_id
 * @property integer $rf_id
 * @property string $log_date
 * @property string $dir
 * @property string $timestamp
 *
 * @property BusDetails $rf
 */
class LogOut extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_out';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rf_id'], 'integer'],
            [['bus_no'], 'integer'],
            [['log_date', 'timestamp'], 'safe'],
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
            'rf_id' => 'Rf ID',
            'log_date' => 'Log Date',
            'dir' => 'Dir',
            'timestamp' => 'Timestamp',
            'bus_no'=>'Bus No',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRf()
    {
        return $this->hasOne(BusDetails::className(), ['rf_id' => 'rf_id']);
    }
}
