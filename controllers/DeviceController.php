<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Device;

class DeviceController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'ping' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new \app\models\DeviceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'devices' => $dataProvider->getModels(),
        ]);
    }

    public function actionCreate()
    {
        $model = new Device();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    public function actionDeviceStats()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'total' => Device::find()->count(),
            'ping_success' => Device::find()->where(['ping_status' => 1])->count(),
            'ping_failed' => Device::find()->where(['ping_status' => 0])->count(),
        ];
    }

    public function actionPing($id)
    {
        $model = $this->findModel($id);
        $ip = escapeshellarg($model->ip_address);

        try {
            $output = shell_exec("ping -c 4 $ip 2>&1");
            $success = strpos($output, '0% packet loss') !== false;
            $model->ping_output = $output;
            $model->ping_status = $success;
            $model->save(false);

            Yii::$app->session->setFlash('success', "Ping completed for {$model->ip_address}.");
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', 'Ping failed: ' . $e->getMessage());
        }

        return $this->redirect(['index']);
    }

    public function actionFetchForm()
{
    $model = new Device();

    if (Yii::$app->request->isPost) {
        $post = Yii::$app->request->post();
        $ip = $post['Device']['ip_address'] ?? null;

        if ($ip) {
            return $this->redirect(['fetch-data', 'ip' => $ip]);
        } else {
            Yii::$app->session->setFlash('error', 'Please enter a valid IP address.');
        }
    }

    return $this->render('fetch-form', ['model' => $model]);
}

public function actionFetchData($ip)
{
    try {
        $url = "https://api.incolumitas.com/?q=" . urlencode($ip);
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (!$data || empty($data['ip'])) {
            Yii::$app->session->setFlash('error', 'Invalid data received from API.');
            return $this->redirect(['fetch-form']);
        }

        // Load or create device
        $model = Device::findOne(['ip_address' => $data['ip']]) ?? new Device();
        $model->ip_address = $data['ip'];
        $model->hostname = $data['hostname'] ?? null;
        $model->dc_network = $data['datacenter']['network'] ?? null;
        $model->asn_network = (string)($data['asn']['asn'] ?? null);
        $model->asn_asn_route = $data['asn']['route'] ?? null;
        $model->location_latitude = (string)($data['location']['latitude'] ?? null);
        $model->location_longitude = (string)($data['location']['longitude'] ?? null);
        $model->rir = $data['rir'] ?? null;
        $model->company_network = $data['company']['network'] ?? null;
        $model->ping_status = null;
        $model->ping_output = null;


        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Device info saved successfully.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to save device: ' . json_encode($model->getErrors()));
        }
    } catch (\Exception $e) {
        Yii::$app->session->setFlash('error', 'Fetch failed: ' . $e->getMessage());
    }

    return $this->redirect(['fetch-form']);
}


    protected function findModel($id)
    {
        if (($model = Device::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested device does not exist.');
    }
}
