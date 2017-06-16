<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($_SERVER['REQUEST_METHOD']=='POST'){
    $api = 'https://data.gov.in/api/datastore/resource.json?resource_id=9ef84268-d588-465a-a308-a864a43d0070&api-key=7dbc4787db762706c7ec4cb3ec0fafba&limit=184130421,100';
    $result = file_get_contents($api);
    $jsonData = json_decode($result,true);
    
    mysql_connect('localhost','doctorg','Server2');
    mysql_select_db("Krishann");
    $state = $jsonData['records'][0]['state'];
    //var_dump($jsonData['records']);
    
    $count = COUNT($jsonData['records']);
    FOREACH($jsonData['records'] AS $row){
        
        $ID = $row['id'];
        $timestamp = $row['timestamp'];
        $state = $row['state'];
        $district = $row['district'];
        $market = $row['market'];
        $commodity = $row['commodity'];
        $variety = $row['variety'];
        $arrival_date = $row['arrival_date'];
        $min_price = $row['min_price'];
        $max_price = $row['max_price'];
        $modal_price = $row['modal_price'];
        
        mysql_query("INSERT INTO krishann_commodity (id,timestamp,state,district,market,commodity,variety,arrival_date,min_price,max_price,modal_price) VALUES ('$ID','$timestamp','$state','$district','$market','$commodity','$variety','$arrival_date','$min_price','$max_price','$modal_price')");
        //echo $state;exit(); 
        
    }
    
    
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <h1>Krishann</h1>
        <form method="post" action="<?php echo $_SERVER["SELF"]; ?>">
            <input type="submit" name="submit" value="submit">    
        </form>
       
        
    </body>
</html>
<?php 

?>
