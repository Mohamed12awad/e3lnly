<?php

    //integration with elephantsql
        $db_host="packy.db.elephantsql.com"; //localhost server 
        $db_name="gifkmbzi"; //database name
        $db_user="gifkmbzi"; //database username
        $db_password="EpDAJXA0tsYQbuQlzxtCsOvAOuzcFXHD"; //database password 
    

    //Tables names:
    $agency_tb = "agency"; //change between brackets with your table name
    $customer_tb = "customer"; //change between brackets with your table name
    $billboard_tb = "billboard"; //change between brackets with your table name
    $television_tb = "tvad"; //change between brackets with your table name
    $website_tb = "websitead"; //change between brackets with your table name
    $channel_tb = "channel"; //change between brackets with your table name
    $customer_request_tb = "customer_request";
try
{
	$db=new PDO("pgsql:host={$db_host};dbname={$db_name}", $db_user, $db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
	$e->getMessage();
}

?>
