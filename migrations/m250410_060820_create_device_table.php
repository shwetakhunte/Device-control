<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%device}}`.
 */
class m250410_060820_create_device_table extends Migration
{
    /**
     * {@inheritdoc}
     */
        public function safeUp()
    {
        $this->createTable('device', [
            'id' => $this->primaryKey(),
            'ip_address' => $this->string()->notNull()->unique(),
            'hostname' => $this->string(),
            'serial' => $this->string(),
            'ping_status' => $this->boolean(),
            'ping_output' => $this->text(),
            'dc_network' => $this->string(),
            'asn_network' => $this->string(),
            'asn_asn_route' => $this->string(),
            'location_latitude' => $this->string(),
            'location_longitude' => $this->string(),
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%device}}');
    }
}
