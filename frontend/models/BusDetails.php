<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bus_details".
 *
 * @property integer $bus_id
 * @property string $bus_no
 * @property integer $rc_no
 * @property string $driver_name
 * @property integer $rf_id
 * @property string $route
 *
 * @property Log[] $logs
 */
class BusDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['bus_no', 'driver_name', 'rf_id', 'route','r_no'], 'required'],
            [['rf_id'], 'integer'],
            [['r_no'], 'string', 'max' => 15],
            [['bus_no'], 'string', 'max' => 15],
            [['driver_name', 'route'], 'string', 'max' => 25],
            [['bus_no'], 'unique', 'message' => 'This Bus Number has already been taken.'],
            [['r_no'], 'unique', 'message' => 'This RC Number has already been taken.'],
            [['rf_id'], 'unique', 'message' => 'This RFID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bus_id' => 'Bus ID',
            'bus_no' => 'Bus No',
            'r_no' => 'R No',
            'driver_name' => 'Driver Name',
            'rf_id' => 'Rf ID',
            'route' => 'Route',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['rf_id' => 'rf_id']);
    }
}
