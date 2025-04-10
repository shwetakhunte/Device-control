<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Device;
use yii\web\Response;

class ApiController extends Controller
{
    public function actionForm()
    {
        return $this->render('form');
    }

    public function actionFetchData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $ip = Yii::$app->request->post('ip_address');

        if (!$ip) {
            return ['status' => 'fail', 'message' => 'IP address is required'];
        }

        $apiUrl = 'https://api.incolumitas.com/?q=' . urlencode($ip);

        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);

        if (!$data || !isset($data['ip'])) {
            return ['status' => 'fail', 'message' => 'Invalid response from API'];
        }

        $device = Device::findOne(['ip_address' => $ip]);

        if (!$device) {
            $device = new Device();
            $device->ip_address = $ip;
        }

        $device->dc_network = $data['datacenter']['network'] ?? null;
        $device->asn_network = $data['asn']['network'] ?? null;
        $device->asn_asn_route = $data['asn']['route'] ?? null;
        $device->location_latitude = $data['location']['latitude'] ?? null;
        $device->location_longitude = $data['location']['longitude'] ?? null;

        if ($device->save()) {
            return ['status' => 'success', 'message' => 'Device data fetched successfully'];
        }

        return ['status' => 'fail', 'message' => 'Failed to save device'];
    }
}
