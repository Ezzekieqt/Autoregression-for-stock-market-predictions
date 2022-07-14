<?php

//******************** PRIPOJENIE K DATABAZE ********************//
//***********************************************//

//informacie k databaze
$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "analyza_webov";

//connect na databazu
$connect = mysqli_connect($hostname,$username,$password,$databaseName);

//******************** ZLATO ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$gold_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\gold_forecast_govcapital');

//odstranenie tagov
$gold_forecast_text = strip_tags($gold_forecast_text);

//na govcapital sa mazu minule mesiace, vzdy je iba nasledujuci mesiac
//treba si tuto hodnotu ukladat, pretoze govcapital maze historiu (pochopitelne dovody)
$is_month = strtotime("next month");
$month = date('m', time()) +1;


//vypocet posledneho pracovneho dna v mesiaci
$lastdateofthemonth = date("Y-m-t");

$lastworkingday = date('l', strtotime($lastdateofthemonth));

if($lastworkingday == "Saturday") {
    $newdate = strtotime ('-1 day', strtotime($lastdateofthemonth));
    $lastworkingday = date ('j', $newdate);
}
elseif($lastworkingday == "Sunday") {
    $newdate = strtotime ('-2 day', strtotime($lastdateofthemonth));
    $lastworkingday = date ( 'j' , $newdate );
}


//orezanie potrebneho textu
$gold_forecast_text = strstr($gold_forecast_text,date("F",$is_month) . ' 15,', false);
$gold_forecast_text = strstr($gold_forecast_text,'2021', true);

//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $gold_forecast_text, $gold_govcapital);

//print_r($gold_govcapital);


//******************** STRIEBRO ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$silver_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\silver_forecast_govcapital');

//odstranenie tagov
$silver_forecast_text = strip_tags($silver_forecast_text);

//na govcapital sa mazu minule mesiace, vzdy je iba nasledujuci mesiac
//treba si tuto hodnotu ukladat, pretoze govcapital maze historiu (pochopitelne dovody)
$is_month = strtotime("next month");


//orezanie potrebneho textu
$silver_forecast_text = strstr($silver_forecast_text,date("F",$is_month) . ' 15,', false);
$silver_forecast_text = strstr($silver_forecast_text,'2021', true);

//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $silver_forecast_text, $silver_govcapital);

//print_r($silver_govcapital);


//******************** BITCOIN ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$bitcoin_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\bitcoin_forecast_govcapital');



//odstranenie tagov
$bitcoin_forecast_text = strip_tags($bitcoin_forecast_text);

//$bitcoin_forecast_text = preg_replace("/[^a-zA-Z0-9,.\-%]/", " ", $bitcoin_forecast_text);

//na govcapital sa mazu minule mesiace, vzdy je iba nasledujuci mesiac
//treba si tuto hodnotu ukladat, pretoze govcapital maze historiu (pochopitelne dovody)
$is_month = strtotime("next month");

//echo $bitcoin_forecast_text;

//orezanie potrebneho textu
$bitcoin_forecast_text = strstr($bitcoin_forecast_text,'2021 ' . date("F",$is_month) . ' 15,',  false);
$bitcoin_forecast_text = strstr($bitcoin_forecast_text,'2021 ' . date("F",$is_month) . ' 16,', true);


//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $bitcoin_forecast_text, $bitcoin_govcapital);

//print_r($bitcoin_govcapital);

//******************** UKLADANIE DO DATABAZY PRE ZLATO ********************//
//*************************************************************************//

$id = '';
$id_stranky = '2';
$aktivum = 'zlato';
$datum = date("d/m");
$predpoved_na = '15/' . $month;
$hodnota = $gold_govcapital[0][1];
$dalsi_tyzden = '-';


$sql = "INSERT INTO aktiva (id, id_stranky, aktivum, datum, predpoved_na, hodnota, dalsi_tyzden)
VALUES ('$id', '$id_stranky', '$aktivum', CURRENT_TIMESTAMP, '$predpoved_na', '$hodnota', '$dalsi_tyzden' )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}


//******************** UKLADANIE DO DATABAZY PRE STRIEBRO ********************//
//*************************************************************************//

$id = '';
$id_stranky = '2';
$aktivum = 'striebro';
$datum = date("d/m");
$predpoved_na = '15/' . $month;
$hodnota = $silver_govcapital[0][1];
$dalsi_tyzden = '-';


$sql = "INSERT INTO aktiva (id, id_stranky, aktivum, datum, predpoved_na, hodnota, dalsi_tyzden)
VALUES ('$id', '$id_stranky', '$aktivum', CURRENT_TIMESTAMP, '$predpoved_na', '$hodnota', '$dalsi_tyzden' )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}


//******************** UKLADANIE DO DATABAZY PRE BITCOIN ********************//
//*************************************************************************//

$id = '';
$aktivum = 'bitcoin';
$id_stranky = '2';
$datum = date("d/m");
$predpoved_na = '15/' . $month;
$dalsi_mesiac = $bitcoin_govcapital[0][4];
$dalsi_tyzden = '-';


$sql = "INSERT INTO aktiva (id, id_stranky, aktivum, datum, predpoved_na, hodnota, dalsi_tyzden)
VALUES ('$id', '$id_stranky', '$aktivum', CURRENT_TIMESTAMP, '$predpoved_na', '$dalsi_mesiac', '$dalsi_tyzden' )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

//*************************** UZATVORENIE DATABAZY *************************//
$connect->close();
