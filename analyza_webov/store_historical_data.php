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

//******************** UKLADANIE DO DATABAZY ********************//
//***********************************************//

$predpoved ='';


$id = '';
$nazvy_aktiv = array('zlato','striebro','bitcoin', 'eurusd','oil','apple');
$cesty_ku_fileom = array('C:\xampp\htdocs\analyza_webov\historical_data_gold.txt',
    'C:\xampp\htdocs\analyza_webov\historical_data_silver.txt',
    'C:\xampp\htdocs\analyza_webov\historical_data_bitcoin.txt',
    'C:\xampp\htdocs\analyza_webov\historical_data_eurusd.txt',
    'C:\xampp\htdocs\analyza_webov\historical_data_oil.txt',
    'C:\xampp\htdocs\analyza_webov\historical_data_apple.txt');


for($i = 0;$i<sizeof($nazvy_aktiv);$i++){

    $pattern = "/".date('Y-m-d', strtotime('Last Monday'))."/";
    echo $pattern;

    $fh = fopen($cesty_ku_fileom[$i], 'r') or die($php_errormsg);
    while (!feof($fh)){
        $line = fgets($fh, 4096);

        if (preg_match($pattern, $line)) {
            $ora_books[ ] = $line;
            $array_of_values = explode(',',$line);
            print_r($array_of_values);
        }

        }

        fclose($fh);


    $sql = "UPDATE stranky SET realna='".$array_of_values[2]."' WHERE datum='".$array_of_values[0]."' and aktivum='".$nazvy_aktiv[$i]."'";

    if ($connect->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

}

$connect->close();