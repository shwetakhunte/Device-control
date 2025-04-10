<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\base\DynamicModel;
use app\models\Device;

class FetchController extends Controller
{
    public function actionIndex()
    {
        $model = new DynamicModel(['ip_address']);
        $model->addRule(['ip_address'], 'required');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->redirect(['fetch-data', 'ip' => $model->ip_address]);
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionFetchData($ip)
    {
        $device = Device::findOne(['ip_address' => $ip]) ?? new Device(['ip_address' => $ip]);

        try {
            $json = file_get_contents("https://api.incolumitas.com/?q=$ip");
            $data = json_decode($json, true);

            $device->dc_network = $data['datacenter']['network'] ?? null;
            $device->asn_network = $data['asn']['network'] ?? null;
            $device->asn_asn_route = $data['asn']['route'] ?? null;
            $device->location_latitude = $data['location']['latitude'] ?? null;
            $device->location_longitude = $data['location']['longitude'] ?? null;
            $device->save();

            Yii::$app->session->setFlash('success', 'IP data fetched successfully.');
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', 'Fetch error: ' . $e->getMessage());
        }

        return $this->redirect(['index']);
    }
}
