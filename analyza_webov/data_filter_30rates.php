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
$gold_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\gold_forecast_30rates.txt');

//odstranenie tagov
$gold_forecast_text = strip_tags($gold_forecast_text);

// Create a new DateTime object
$nextMonday = date('Y-m-d', strtotime('next week Monday'));

// Modify the date it contains




//orezanie potrebneho textu
$gold_forecast_text = strstr($gold_forecast_text,'Monday', false);
$gold_forecast_text = strstr($gold_forecast_text,'Tuesday', true);



//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $gold_forecast_text, $gold_30rates);

print_r($gold_30rates);
print_r($nextMonday);


//******************** STRIEBRO ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$silver_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\silver_forecast_30rates.txt');

//odstranenie tagov
$silver_forecast_text = strip_tags($silver_forecast_text);

//orezanie potrebneho textu
$silver_forecast_text = strstr($silver_forecast_text,'Monday', false);
$silver_forecast_text = strstr($silver_forecast_text,'Tuesday', true);

//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $silver_forecast_text, $silver_30rates);

print_r($silver_30rates);

//******************** BITCOIN ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$bitcoin_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\bitcoin_forecast_30rates.txt');


//odstranenie tagov
//$bitcoin_forecast_text = strip_tags($bitcoin_forecast_text);

//orezanie potrebneho textu
$bitcoin_forecast_text = strstr($bitcoin_forecast_text,'Monday', false);
$bitcoin_forecast_text = strstr($bitcoin_forecast_text,'Tuesday', true);

//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $bitcoin_forecast_text, $bitcoin_30rates);

print_r($bitcoin_30rates);

//******************** EURUSD ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$eurusd_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\eurusd_forecast_30rates.txt');

//odstranenie tagov
$eurusd_forecast_text = strip_tags($eurusd_forecast_text);

//orezanie potrebneho textu
$eurusd_forecast_text = strstr($eurusd_forecast_text,'Monday', false);
$eurusd_forecast_text = strstr($eurusd_forecast_text,'Tuesday', true);

//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $eurusd_forecast_text, $eurusd_30rates);

print_r($eurusd_30rates);

//******************** OIL ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$oil_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\oil_forecast_30rates.txt');

//odstranenie tagov
$oil_forecast_text = strip_tags($oil_forecast_text);

//orezanie potrebneho textu
$oil_forecast_text = strstr($oil_forecast_text,'Monday', false);
$oil_forecast_text = strstr($oil_forecast_text,'Tuesday', true);

//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $oil_forecast_text, $oil_30rates);

print_r($oil_30rates);

//******************** APPLE ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$apple_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\apple_forecast_30rates.txt');

//odstranenie tagov
$apple_forecast_text = strip_tags($apple_forecast_text);

//orezanie potrebneho textu
$apple_forecast_text = strstr($apple_forecast_text,'Monday', false);
$apple_forecast_text = strstr($apple_forecast_text,'Tuesday', true);

//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $apple_forecast_text, $apple_30rates);

print_r($apple_30rates);


//******************** UKLADANIE DO DATABAZY PRE ZLATO ********************//
//*************************************************************************//



$id = '';
$aktivum = 'zlato';
$stranka = '30rates';
$hodnota = $gold_30rates[0][1];


$sql = "INSERT INTO stranky (id, aktivum, stranka, hodnota, datum, zo_dna)
VALUES ('$id', '$aktivum','$stranka','$hodnota', '$nextMonday',CURRENT_DATE )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}


//******************** UKLADANIE DO DATABAZY PRE STRIEBRO ********************//
//*************************************************************************//

$id = '';
$aktivum = 'striebro';
$stranka = '30rates';
$hodnota = $silver_30rates[0][1];


$sql = "INSERT INTO stranky (id, aktivum, stranka, hodnota, datum, zo_dna)
VALUES ('$id', '$aktivum','$stranka','$hodnota', '$nextMonday', CURRENT_DATE )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}


//******************** UKLADANIE DO DATABAZY PRE BITCOIN ********************//
//*************************************************************************//

$id = '';
$aktivum = 'bitcoin';
$stranka = '30rates';
$hodnota = $bitcoin_30rates[0][3];


$sql = "INSERT INTO stranky (id, aktivum, stranka, hodnota, datum, zo_dna)
VALUES ('$id', '$aktivum','$stranka','$hodnota', '$nextMonday', CURRENT_DATE )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

//******************** UKLADANIE DO DATABAZY PRE EURUSD ********************//
//*************************************************************************//

$id = '';
$aktivum = 'eurusd';
$stranka = '30rates';
$hodnota = $eurusd_30rates[0][1];


$sql = "INSERT INTO stranky (id, aktivum, stranka, hodnota, datum, zo_dna)
VALUES ('$id', '$aktivum','$stranka','$hodnota', '$nextMonday', CURRENT_DATE )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

//******************** UKLADANIE DO DATABAZY PRE OIL ********************//
//*************************************************************************//

$id = '';
$aktivum = 'oil';
$stranka = '30rates';
$hodnota = $oil_30rates[0][1];


$sql = "INSERT INTO stranky (id, aktivum, stranka, hodnota, datum, zo_dna)
VALUES ('$id', '$aktivum','$stranka','$hodnota', '$nextMonday', CURRENT_DATE )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

//******************** UKLADANIE DO DATABAZY PRE APPLE ********************//
//*************************************************************************//

$id = '';
$aktivum = 'apple';
$stranka = '30rates';
$hodnota = $apple_30rates[0][1];


$sql = "INSERT INTO stranky (id, aktivum, stranka, hodnota, datum, zo_dna)
VALUES ('$id', '$aktivum','$stranka','$hodnota', '$nextMonday', CURRENT_DATE )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}



//*************************** UZATVORENIE DATABAZY *************************//
$connect->close();

