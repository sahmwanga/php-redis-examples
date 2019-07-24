<?php


require_once "vendor/autoload.php";

$client = new Predis\Client([
    'scheme'=>'tcp',
    'host'=>"127.0.0.1",
    'port'=>6379
]);


//database conf



$response = $client->pipeline(function($pipe){
    $sql = array();

    for ($i=0; $i<5000; $i++){
        $pipe->set("key:$i",str_pad($i,4,'0',0));
        //        $pipe->get("key:$i");
        $sql[]='("name '.$i.'")';
//        echo 'test '.$i."  \n";
    }


    $host ="";
    $username="";
    $password="";
    $db="redis";

    $conn = new mysqli($host,$username,$password,$db);

    if(!$conn->connect_error){
        //db execution
        $query = "insert into users(name) values ".implode(',',$sql);
//        echo $query;
        mysqli_query($conn,$query);
    }else{
        die('Connection failed '.$conn->connect_error);
    }
////

});

//
////$response = $client
////    ->pipeline()->set('foo','bar')->get('foo')->execute();
//
//print_r($response);

?>
