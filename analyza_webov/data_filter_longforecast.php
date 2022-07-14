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
$gold_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\gold_forecast_longforecast');

//odstranenie tagov
$gold_forecast_text = strip_tags($gold_forecast_text);

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

$is_month = date('m', time()) +1;

$monthName = date("F", mktime(0, 0, 0, $is_month, 10));

//orezanie potrebneho textu
$gold_forecast_text = strstr($gold_forecast_text,$monthName, false);
$gold_forecast_text = strstr($gold_forecast_text,$monthName . ' 2022', true);



//ulozenie do pola matches, ulozi iba digits znaky, cize odstrani text
//regex zoberie vsetky realne cisla z textu, vyseparuje ich od textu a ulozi do pola gold_longforecast
preg_match_all('!-?[0-9]*\.?[0-9]+!', $gold_forecast_text, $gold_longforecast);

//vymaze nepotrebne cisla z pola(reklamy a linky pridane na konkretne miesto na stranke)
array_splice($gold_longforecast[0],36, 3);

//print_r($gold_longforecast);


//******************** STRIEBRO ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$silver_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\silver_forecast_longforecast');

//odstranenie tagov
$silver_forecast_text = strip_tags($silver_forecast_text);

//orezanie potrebneho textu
$silver_forecast_text = strstr($silver_forecast_text,$monthName, false);
$silver_forecast_text = strstr($silver_forecast_text,' 2022', true);

//ulozenie do pola matches, ulozi iba digits znaky, cize odstrani text
preg_match_all('!-?[0-9]*\.?[0-9]+!', $silver_forecast_text, $silver_longforecast);

//vymaze nepotrebne cisla z pola(reklamy a linky pridane na konkretne miesto na stranke)
array_splice($silver_longforecast[0],35, 7);

//print_r($silver_longforecast);


//******************** BITCOIN ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$bitcoin_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\bitcoin_forecast_longforecast');



$bitcoin_forecast_text = preg_replace("/[^a-zA-Z0-9,.\-%]/", " ", $bitcoin_forecast_text);

//odstranenie tagov
$bitcoin_forecast_text = strip_tags($bitcoin_forecast_text);


//orezanie potrebneho textu
$bitcoin_forecast_text = strstr($bitcoin_forecast_text,$monthName, false);
$bitcoin_forecast_text = strstr($bitcoin_forecast_text,' 2022', true);

//echo $bitcoin_forecast_text;

//ulozenie do pola matches, ulozi iba digits znaky, cize odstrani text
preg_match_all('!-?[0-9]*\.?[0-9]+!', $bitcoin_forecast_text, $bitcoin_longforecast);


//vymaze nepotrebne cisla z pola(reklamy a linky pridane na konkretne miesto na stranke)
array_splice($bitcoin_longforecast[0],35, 14);
array_splice($bitcoin_longforecast[0],70, 3);

//print_r($bitcoin_longforecast);

//******************** UKLADANIE DO DATABAZY PRE ZLATO ********************//
//*************************************************************************//

$id = '';
$id_stranky = '1';
$aktivum = 'zlato';
$datum = date("d/m");
$predpoved_na = '15/' . $is_month;
$hodnota = $gold_longforecast[0][4];
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
$aktivum = 'striebro';
$id_stranky = '1';
$datum = date("d/m");
$predpoved_na = '15/' . $is_month;
$dalsi_mesiac = $silver_longforecast[0][4];
$dalsi_tyzden = '-';


$sql = "INSERT INTO aktiva (id, id_stranky, aktivum, datum, predpoved_na, hodnota, dalsi_tyzden)
VALUES ('$id', '$id_stranky', '$aktivum', CURRENT_TIMESTAMP, '$predpoved_na', '$dalsi_mesiac', '$dalsi_tyzden' )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

//******************** UKLADANIE DO DATABAZY PRE BITCOIN ********************//
//*************************************************************************//

$id = '';
$aktivum = 'bitcoin';
$id_stranky = '1';
$datum = date("d/m");
$predpoved_na = $is_month;
$dalsi_mesiac = $bitcoin_longforecast[0][4];
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






