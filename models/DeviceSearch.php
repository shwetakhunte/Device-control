<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class DeviceSearch extends Device
{
    public function rules()
    {
        return [
            [['id', 'ping_status'], 'integer'],
            [['ip_address', 'hostname', 'serial', 'ping_output', 'dc_network', 'asn_network', 'asn_asn_route', 'location_latitude', 'location_longitude'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, $formName = null)
    {
        $query = Device::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'ping_status' => $this->ping_status,
        ]);

        $query->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'hostname', $this->hostname])
            ->andFilterWhere(['like', 'serial', $this->serial])
            ->andFilterWhere(['like', 'ping_output', $this->ping_output])
            ->andFilterWhere(['like', 'dc_network', $this->dc_network])
            ->andFilterWhere(['like', 'asn_network', $this->asn_network])
            ->andFilterWhere(['like', 'asn_asn_route', $this->asn_asn_route])
            ->andFilterWhere(['like', 'location_latitude', $this->location_latitude])
            ->andFilterWhere(['like', 'location_longitude', $this->location_longitude]);

        return $dataProvider;
    }
}
