<?php
/*
$transport = new TSocket('localhost', 10000);
$protocol = new TBinaryProtocol($transport);
$client = new ThriftHiveClient($protocol);
$transport->open();
// run queries, metadata calls etc

$client->execute('add jar /usr/local/hadoop/hive/lib/hive-contrib-0.10.0.jar');
$client->execute('select count(1) from item');
var_dump($client->fetchAll());
$transport->close();  */

$GLOBALS['THRIFT_ROOT'] = dirname(__FILE__).'/thrift/src';
require_once( $GLOBALS['THRIFT_ROOT'].'/Thrift.php' );
require_once( $GLOBALS['THRIFT_ROOT'].'/transport/TSocket.php' );
require_once( $GLOBALS['THRIFT_ROOT'].'/transport/TBufferedTransport.php' );
require_once( $GLOBALS['THRIFT_ROOT'].'/protocol/TBinaryProtocol.php' );

//hbase thrift
require_once dirname(__FILE__).'/thrift/Hbase.php';

//hive thrift
//require_once dirname(__FILE__).'/thrift/ThriftHive.php';

/*
HBase php thrift client
*/

//open connection

$socket = new TSocket('localhost', 9090);
$transport = new TBufferedTransport( $socket );
$protocol = new TBinaryProtocol( $transport );
$client = new HbaseClient( $protocol );
$transport->open();
$tables = $client->getTableNames();
foreach ( $tables as $name ) {
echo( "  found: {$name}\n" );
}

$table_name = "test";
    $row_name = "row1";
    $arr = $client->getRow($table_name, $row_name);
    print_r($arr['0']);die;
    // $client->getRow return a array
    foreach ( $arr as $k=>$TRowResult  ) {
    // $k = 0 ; non-use
    // $TRowResult = TRowResult
    //var_dump($TRowResult);
    print_r($TRowResult->columns);
    }

//print_r($db_array);


/*
require_once dirname(__FILE__).'/thrift/ThriftHive.php';
$transport = new TSocket('localhost', 10000);
$protocol = new TBinaryProtocol($transport);
$client = new ThriftHiveClient($protocol);
$transport->open();
//$client->execute('add jar /usr/local/hadoop/hive/lib/hive-contrib-0.10.0.jar');
$client->execute('select * from item sort by volume desc limit 1');
$data = $client->fetchAll();
$transport->close();
//echo $data[0];
$arr = explode('	',$data[0]);
print_r($arr);
*/

?>
