<?php
include_once 'database.php';

//******************** VYPOCET A UKLADANIE DO DATABAZY ********************//
//***********************************************//

$nazvy_aktiv = array('zlato','striebro','bitcoin', 'eurusd','oil','apple');
$last_monday = date('Y-m-d', strtotime('Last Monday'));
$next_monday = date('Y-m-d', strtotime('Next Monday'));

for($i = 0;$i<sizeof($nazvy_aktiv);$i++){

    $sql_predp = "SELECT hodnota,DATUM FROM `stranky` WHERE aktivum='".$nazvy_aktiv[$i]."' AND realna=0
                    ORDER BY `stranky`.`datum` DESC LIMIT 10";
    $res_predp = mysqli_query($connect, $sql_predp);

    $pred = (($res_predp->fetch_row()[0] + $res_predp->fetch_row()[0]) / 2);

    $sql_hist = "SELECT DISTINCT realna FROM `stranky` WHERE datum='".$last_monday."' AND aktivum='".$nazvy_aktiv[$i]."'";
    $res_hist = mysqli_query($connect, $sql_hist);

    $hist = $res_hist->fetch_row()[0];

    $id = '';
    $sql = "SELECT intercept,hist, predp from koeficienty WHERE nazov='".$nazvy_aktiv[$i]."'";
    $result = $connect->query($sql);


//vypocet
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $prediction_price = $row['intercept'] + $row['hist']*$hist + $row['predp']*$pred;
        }
    } else {
        echo "0 results";
    }

//ukladanie
    $sql_store = "INSERT INTO predpovede (id, nazov, predpoved_na, hodnota)
                    VALUES ('$id', '".$nazvy_aktiv[$i]."', '$next_monday', '$prediction_price' )";

    if ($connect->query($sql_store) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql_store . "<br>" . $connect->error;
    }

}

$connect->close();




