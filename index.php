<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$district=array('Ahmednagar','Akola','Amarawati','Aurangabad','Bandra(E)','Beed','Bhandara',
'Buldhana','Chandrapur','Dharashiv(Usmanabad)','Dhule','Gadchiroli','Gondiya','Hingoli',
'Jalana','Jalgaon','Kolhapur','Latur','Mumbai','Nagpur','Wardha25','Sindhudurg13','Osmanabad',
'Parbhani','Pune','Raigad','Ratnagiri','Nandurbar','Satara','Sholapur','Thane','Vashim','Yavatmal');

//var_dump($district);
if($_SERVER['REQUEST_METHOD']=='POST'){
    foreach ($district as $value) {
        
     // var_dump($value);        exit();     
    
    $api = "https://data.gov.in/api/datastore/resource.json?resource_id=9ef84268-d588-465a-a308-a864a43d0070&api-key=7dbc4787db762706c7ec4cb3ec0fafba&"
            . "filters[district]=".$value."";
    //var_dump($api);        exit();
    //&fields=id,timestamp,district 
    //$api = 'https://data.gov.in/api/datastore/resource.json?resource_id=9ef84268-d588-465a-a308-a864a43d0070&api-key=7dbc4787db762706c7ec4cb3ec0fafba&filters[state]=Maharashtra';
    $result = file_get_contents($api);
    $jsonData = json_decode($result,true);
   //var_dump($jsonData);        exit(); 
    $conn=mysql_connect('localhost','doctorg','Server2');
    mysql_select_db("Krishann");
    $state = $jsonData['records'][0]['state'];
    $count = COUNT($jsonData['records']);
    $i=1;
    FOREACH($jsonData['records'] AS $row){
        $i=
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
        $date = new DateTime("@$timestamp");
        $date_time = $date->format('Y-m-d H:i:s');
        
        mysql_query("INSERT INTO krishann_commodity (id,timestamp,state,district,market,commodity,variety,arrival_date,min_price,max_price,modal_price) VALUES ('$ID','$date_time','$state','$district','$market','$commodity','$variety','$arrival_date','$min_price','$max_price','$modal_price')");
        //echo $state;exit(); 
        
    }
    mysql_close($conn);
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
