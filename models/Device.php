<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property int $id
 * @property string $ip_address
 * @property string|null $hostname
 * @property string|null $serial
 * @property int|null $ping_status
 * @property string|null $ping_output
 * @property string|null $dc_network
 * @property string|null $asn_network
 * @property string|null $asn_asn_route
 * @property string|null $location_latitude
 * @property string|null $location_longitude
 */
class Device extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip_address', 'hostname', 'serial', 'ping_output', 'dc_network', 'asn_network', 'asn_asn_route', 'location_latitude', 'location_longitude'], 'safe'],
            [['ping_status'], 'integer'],
        ];
    }
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip_address' => 'Ip Address',
            'hostname' => 'Hostname',
            'serial' => 'Serial',
            'ping_status' => 'Ping Status',
            'ping_output' => 'Ping Output',
            'dc_network' => 'Dc Network',
            'asn_network' => 'Asn Network',
            'asn_asn_route' => 'Asn Asn Route',
            'location_latitude' => 'Location Latitude',
            'location_longitude' => 'Location Longitude',
        ];
    }

}
