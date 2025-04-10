<?php

use yii\db\Migration;

class m250410_083636_add_device_api_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
{
    // $this->addColumn('device', 'dc_network', $this->string());
    // $this->addColumn('device', 'asn_network', $this->string());
    // $this->addColumn('device', 'asn_asn_route', $this->string());
    // $this->addColumn('device', 'location_latitude', $this->string());
    // $this->addColumn('device', 'location_longitude', $this->string());
}




    /**
     * {@inheritdoc}
     */
    public function safeDown()
{
    $this->dropColumn('device', 'dc_network');
    $this->dropColumn('device', 'asn_network');
    $this->dropColumn('device', 'asn_asn_route');
    $this->dropColumn('device', 'location_latitude');
    $this->dropColumn('device', 'location_longitude');
}

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250410_083636_add_device_api_fields cannot be reverted.\n";

        return false;
    }
    */
}
