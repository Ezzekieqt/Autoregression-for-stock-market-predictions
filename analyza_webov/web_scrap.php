<?php

$web_scraps = array();
$web_scraps_names = array('gold_forecast_longforecast.txt','silver_forecast_longforecast.txt','bitcoin_forecast_longforecast.txt', 'gold_forecast_30rates.txt','silver_forecast_30rates.txt','bitcoin_forecast_30rates.txt','eurusd_forecast_30rates.txt','oil_forecast_30rates.txt'
,'apple_forecast_30rates.txt', 'gold_forecast_walletinvestor.txt', 'silver_forecast_walletinvestor.txt', 'bitcoin_forecast_walletinvestor.txt', 'eurusd_forecast_walletinvestor.txt', 'oil_forecast_walletinvestor.txt', 'apple_forecast_walletinvestor.txt');


//scrap z URL

//******************** WALLETINVESTOR ********************//
//***********************************************//

$gold_forecast_walletinvestor = curl_init('https://walletinvestor.com/commodity-forecast/gold-prediction');
$silver_forecast_walletinvestor = curl_init('https://walletinvestor.com/commodity-forecast/silver-prediction');
$bitcoin_forecast_walletinvestor = curl_init('https://walletinvestor.com/forecast/bitcoin-prediction');
$eurusd_forecast_walletinvestor = curl_init('https://walletinvestor.com/forex-forecast/eur-usd-prediction');
$oil_forecast_walletinvestor = curl_init('https://walletinvestor.com/commodity-forecast/crude-oil-prediction');
$apple_forecast_walletinvestor = curl_init('https://walletinvestor.com/stock-forecast/aapl-stock-prediction');


//******************** LONGFORECAST ********************//
//***********************************************//

$gold_forecast_longforecast = curl_init('https://longforecast.com/gold-price-today-forecast-2017-2018-2019-2020-2021-ounce-gram');
$silver_forecast_longforecast = curl_init('https://longforecast.com/silver-price-today-forecast-2017-2018-2019-2020-2021-ounce-gram');
$bitcoin_forecast_longforecast = curl_init('https://longforecast.com/bitcoin-price-predictions-2017-2018-2019-btc-to-usd');

//******************** 30rates ********************//
//***********************************************//

$gold_forecast_30rates = curl_init('http://30rates.com/gold-price-forecast-and-predictions');
$silver_forecast_30rates = curl_init('http://30rates.com/silver-price-forecast');
$bitcoin_forecast_30rates = curl_init('http://30rates.com/btc-to-usd-forecast-today-dollar-to-bitcoin');
$eurusd_forecast_30rates = curl_init('http://30rates.com/eur-usd-forecast-tomorrow-this-week');
$oil_forecast_30rates = curl_init('http://30rates.com/oil-price-forecast-and-predictions');
$apple_forecast_30rates = curl_init('http://30rates.com/apple');

//******************** GOVCAPITAL ********************//
//***********************************************//

$gold_forecast_govcapital = curl_init('https://gov.capital/commodity/gold/');
$silver_forecast_govcapital = curl_init('https://gov.capital/commodity/silver/');
$bitcoin_forecast_govcapital = curl_init('https://gov.capital/crypto/bitcoin/');

//******************** HISTORICKE DATA ********************//
//***********************************************//
//usek kodu od riadku 71-95 som pouzil zo stranky: https://stackoverflow.com/questions/13168198/download-file-from-url-using-curl
//poznamka: for cyklus pomenuva jednotlive textove files podla poradia ako su v poli $nazvy_aktiv
//preto musi poradie URLiek v $historical_data_URLs ostat rovnake ako v $nazvy_aktiv

$dt = date_create();
$current_date_timestamp = date_timestamp_get($dt);

$historical_data_URLs = array('https://query1.finance.yahoo.com/v7/finance/download/GC=F?period1=1607644800&period2='.$current_date_timestamp.'&interval=1d&events=history&includeAdjustedClose=true',
    'https://query1.finance.yahoo.com/v7/finance/download/SI=F?period1=1607644800&period2='.$current_date_timestamp.'&interval=1d&events=history&includeAdjustedClose=true',
    'https://query1.finance.yahoo.com/v7/finance/download/BTC-USD?period1=1607644800&period2='.$current_date_timestamp.'&interval=1d&events=history&includeAdjustedClose=true',
    'https://query1.finance.yahoo.com/v7/finance/download/EURUSD=X?period1=1607644800&period2='.$current_date_timestamp.'&interval=1d&events=history&includeAdjustedClose=true',
    'https://query1.finance.yahoo.com/v7/finance/download/CL=F?period1=1607644800&period2='.$current_date_timestamp.'&interval=1d&events=history&includeAdjustedClose=true',
    'https://query1.finance.yahoo.com/v7/finance/download/AAPL?period1=1607644800&period2='.$current_date_timestamp.'&interval=1d&events=history&includeAdjustedClose=true');

/*
$historical_data_URLs = array('https://query1.finance.yahoo.com/v7/finance/download/GC=F?period1=1598227200&period2=1614124800&interval=1mo&events=history&includeAdjustedClose=true',
    'https://query1.finance.yahoo.com/v7/finance/download/SI=F?period1=1598227200&period2=1614124800&interval=1mo&events=history&includeAdjustedClose=true',
    'https://query1.finance.yahoo.com/v7/finance/download/BTC-USD?period1=1598227200&period2=1614124800&interval=1mo&events=history&includeAdjustedClose=true',
    'https://query1.finance.yahoo.com/v7/finance/download/EURUSD=X?period1=1598227200&period2=1614124800&interval=1mo&events=history&includeAdjustedClose=true',
    'https://query1.finance.yahoo.com/v7/finance/download/CL=F?period1=1598227200&period2=1614124800&interval=1mo&events=history&includeAdjustedClose=true',
    'https://query1.finance.yahoo.com/v7/finance/download/AAPL?period1=1598227200&period2=1614124800&interval=1mo&events=history&includeAdjustedClose=true');
*/
$nazvy_aktiv = array('gold','silver','bitcoin', 'eurusd','oil','apple');

for($i = 0; $i<sizeof($historical_data_URLs); $i++){
    $output_filename = "historical_data_".$nazvy_aktiv[$i].".txt";

    $host = $historical_data_URLs[$i];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $host);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, false);
    curl_setopt($ch, CURLOPT_REFERER, "https://finance.yahoo.com/");
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $result = curl_exec($ch);
    curl_close($ch);

    print_r($result); // prints the contents of the collected file before writing..



    // the following lines write the contents to a file in the same directory (provided permissions etc)
    $fp = fopen($output_filename, 'w');
    fwrite($fp, $result);
    fclose($fp);

}

//***********************************************//
//***********************************************//



//naplnenie pola URL adresami
array_push($web_scraps,$gold_forecast_longforecast,$silver_forecast_longforecast,$bitcoin_forecast_longforecast, $gold_forecast_30rates, $silver_forecast_30rates, $bitcoin_forecast_30rates,
    $eurusd_forecast_30rates,$oil_forecast_30rates,$apple_forecast_30rates
, $gold_forecast_walletinvestor,$silver_forecast_walletinvestor,$bitcoin_forecast_walletinvestor,$eurusd_forecast_walletinvestor,$oil_forecast_walletinvestor,$apple_forecast_walletinvestor );

for($i = 0;$i<sizeof($web_scraps);$i++){
    curl_setopt($web_scraps[$i], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($web_scraps[$i], CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($web_scraps[$i], CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($web_scraps[$i]);

    //ulozenie do textoveho dokumentu
    curl_close($web_scraps[$i]);
    file_put_contents(
        $web_scraps_names[$i],
        $response
    );
}




















