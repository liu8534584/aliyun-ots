<?php

use Aliyun\OTS\OTSClient;
use Aliyun\OTS\RowExistenceExpectationConst;

require_once "./vendor/autoload.php";

class OTSApi
{
    private $client;

    public function __construct()
    {
        $this->client = new OTSClient([
            'EndPoint' => '',
            'AccessKeyID' => '',
            'AccessKeySecret' => '',
            'InstanceName' => ''
        ]);
    }

    public function putRow($tableName, $primaryKey = array(), $attributes = array())
    {
        if (empty($primaryKey)) {
            return $primaryKey;
        }
        $request = array(
            'table_name' => $tableName,
            'condition' => RowExistenceExpectationConst::CONST_IGNORE, // condition可以为IGNORE, EXPECT_EXIST, EXPECT_NOT_EXIST
            'primary_key' => $primaryKey,
            'attribute_columns' => $attributes
        );
        $response = $this->client->putRow($request);
        return $response;
    }

    /*
 * 读取单行数据
 */
    public function getRow($tableName, $primaryKey = array())
    {
        if (empty($primaryKey)) {
            return array();
        }
        $request = array(
            'table_name' => $tableName,
            'primary_key' => $primaryKey
        );
        $response = $this->client->getRow($request);
        return $response;
    }
}

$ali = new OTSApi();
$res = $ali->getRow("short_url", ['id' => 5329, 'partitionKey' => '00003e3b9e5336685200ae85d21b4f5e']);
var_dump($res);

