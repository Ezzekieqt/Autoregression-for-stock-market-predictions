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
$gold_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\gold_forecast_walletinvestor.txt');

//odstranenie tagov
$gold_forecast_text = strip_tags($gold_forecast_text);

// Create a new DateTime object
$nextMonday = date('Y-m-d', strtotime('next week Monday'));
$nextTuesday = date('Y-m-d', strtotime('next week Tuesday'));


//orezanie potrebneho textu
$gold_forecast_text = strstr($gold_forecast_text,$nextMonday, false);
$gold_forecast_text = strstr($gold_forecast_text,$nextTuesday, true);



//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $gold_forecast_text, $gold_walletinvestor);

print_r($gold_walletinvestor);

//******************** STRIEBRO ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$silver_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\silver_forecast_walletinvestor.txt');

//odstranenie tagov
$silver_forecast_text = strip_tags($silver_forecast_text);



//orezanie potrebneho textu
$silver_forecast_text = strstr($silver_forecast_text, $nextMonday, false);
$silver_forecast_text = strstr($silver_forecast_text,$nextTuesday, true);



//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $silver_forecast_text, $silver_walletinvestor);

print_r($silver_walletinvestor);

//******************** BITCOIN********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$bitcoin_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\bitcoin_forecast_walletinvestor.txt');


//odstranenie tagov
//$bitcoin_forecast_text = strip_tags($bitcoin_forecast_text);


//orezanie potrebneho textu
$bitcoin_forecast_text = strstr($bitcoin_forecast_text,$nextMonday, false);
$bitcoin_forecast_text = strstr($bitcoin_forecast_text,$nextTuesday, true);


//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $bitcoin_forecast_text, $bitcoin_walletinvestor);

print_r($bitcoin_walletinvestor);

//******************** EURUSD ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$eurusd_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\eurusd_forecast_walletinvestor.txt');

//odstranenie tagov
$eurusd_forecast_text = strip_tags($eurusd_forecast_text);


//orezanie potrebneho textu
$eurusd_forecast_text = strstr($eurusd_forecast_text,$nextMonday, false);
$eurusd_forecast_text = strstr($eurusd_forecast_text,$nextTuesday, true);



//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $eurusd_forecast_text, $eurusd_walletinvestor);

print_r($eurusd_walletinvestor);

//******************** OIL ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$oil_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\oil_forecast_walletinvestor.txt');

//odstranenie tagov
$oil_forecast_text = strip_tags($oil_forecast_text);

//orezanie potrebneho textu
$oil_forecast_text = strstr($oil_forecast_text,$nextMonday, false);
$oil_forecast_text = strstr($oil_forecast_text,$nextTuesday, true);



//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $oil_forecast_text, $oil_walletinvestor);

print_r($oil_walletinvestor);

//******************** APPLE ********************//
//***********************************************//

//ziskanie dat z textoveho suboru
$apple_forecast_text = file_get_contents ('C:\xampp\htdocs\analyza_webov\apple_forecast_walletinvestor.txt');

//odstranenie tagov
$apple_forecast_text = strip_tags($apple_forecast_text);

//orezanie potrebneho textu
$apple_forecast_text = strstr($apple_forecast_text,$nextMonday, false);
$apple_forecast_text = strstr($apple_forecast_text,$nextTuesday, true);



//hodnoty sa ulozia do pola
preg_match_all('!-?[0-9]*\.?[0-9]+!', $apple_forecast_text, $apple_walletinvestor);

print_r($apple_walletinvestor);

//******************** UKLADANIE DO DATABAZY PRE ZLATO ********************//
//*************************************************************************//

$id = '';
$aktivum = 'zlato';
$stranka = 'walletinvestor';
$hodnota = $gold_walletinvestor[0][5];


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
$stranka = 'walletinvestor';
$hodnota = $silver_walletinvestor[0][5];


$sql = "INSERT INTO stranky (id, aktivum, stranka, hodnota, datum, zo_dna)
VALUES ('$id', '$aktivum','$stranka','$hodnota', '$nextMonday',CURRENT_DATE )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

//******************** UKLADANIE DO DATABAZY PRE BITCOIN ********************//
//*************************************************************************//

$id = '';
$aktivum = 'bitcoin';
$stranka = 'walletinvestor';
$hodnota = $bitcoin_walletinvestor[0][11];


$sql = "INSERT INTO stranky (id, aktivum, stranka, hodnota, datum, zo_dna)
VALUES ('$id', '$aktivum','$stranka','$hodnota', '$nextMonday',CURRENT_DATE )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

//******************** UKLADANIE DO DATABAZY PRE EURUSD ********************//
//*************************************************************************//

$id = '';
$aktivum = 'eurusd';
$stranka = 'walletinvestor';
$hodnota = $eurusd_walletinvestor[0][5];


$sql = "INSERT INTO stranky (id, aktivum, stranka, hodnota, datum, zo_dna)
VALUES ('$id', '$aktivum','$stranka','$hodnota', '$nextMonday',CURRENT_DATE )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

//******************** UKLADANIE DO DATABAZY PRE OIL ********************//
//*************************************************************************//

$id = '';
$aktivum = 'oil';
$stranka = 'walletinvestor';
$hodnota = $oil_walletinvestor[0][5];


$sql = "INSERT INTO stranky (id, aktivum, stranka, hodnota, datum, zo_dna)
VALUES ('$id', '$aktivum','$stranka','$hodnota', '$nextMonday',CURRENT_DATE )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

//******************** UKLADANIE DO DATABAZY PRE APPLE ********************//
//*************************************************************************//

$id = '';
$aktivum = 'apple';
$stranka = 'walletinvestor';
$hodnota = $apple_walletinvestor[0][5];


$sql = "INSERT INTO stranky (id, aktivum, stranka, hodnota, datum, zo_dna)
VALUES ('$id', '$aktivum','$stranka','$hodnota', '$nextMonday',CURRENT_DATE )";

if ($connect->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}


//*************************** UZATVORENIE DATABAZY *************************//
$connect->close();