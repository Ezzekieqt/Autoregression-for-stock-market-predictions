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


//******************** NASOBENIE MATIC ********************//
//*************************************************************************//


function matrix_multiplication($a,$b){


    $r=count($a);
    $c=count($b[0]);
    $p=count($b);
    if(count($a[0]) != $p){
        echo "Nekombatibilne matice";
        exit(0);
    }
    $result=array();
    for ($i=0; $i < $r; $i++){
        for($j=0; $j < $c; $j++){
            $result[$i][$j] = 0;
            for($k=0; $k < $p; $k++){
                $result[$i][$j] += $a[$i][$k] * $b[$k][$j];
            }
        }
    }
    return $result;
}

//******************** VYPOCET INVERZNEJ MATICE ********************//
//*************************************************************************//
//tato cast kodu je zo stranky https://stackoverflow.com/questions/1811250/php-inverse-of-a-matrix

class MatrixLibrary
{
    //Gauss-Jordan elimination method for matrix inverse
    public function inverseMatrix(array $matrix)
    {
        //TODO $matrix validation

        $matrixCount = count($matrix);

        $identityMatrix = $this->identityMatrix($matrixCount);
        $augmentedMatrix = $this->appendIdentityMatrixToMatrix($matrix, $identityMatrix);
        $inverseMatrixWithIdentity = $this->createInverseMatrix($augmentedMatrix);
        $inverseMatrix = $this->removeIdentityMatrix($inverseMatrixWithIdentity);

        return $inverseMatrix;
    }

    private function createInverseMatrix(array $matrix)
    {
        $numberOfRows = count($matrix);

        for($i=0; $i<$numberOfRows; $i++)
        {
            $matrix = $this->oneOperation($matrix, $i, $i);

            for($j=0; $j<$numberOfRows; $j++)
            {
                if($i !== $j)
                {
                    $matrix = $this->zeroOperation($matrix, $j, $i, $i);
                }
            }
        }
        $inverseMatrixWithIdentity = $matrix;

        return $inverseMatrixWithIdentity;
    }

    private function oneOperation(array $matrix, $rowPosition, $zeroPosition)
    {
        if($matrix[$rowPosition][$zeroPosition] !== 1)
        {
            $numberOfCols = count($matrix[$rowPosition]);

            if($matrix[$rowPosition][$zeroPosition] === 0)
            {
                $divisor = 0.0000000001;
                $matrix[$rowPosition][$zeroPosition] = 0.0000000001;
            }
            else
            {
                $divisor = $matrix[$rowPosition][$zeroPosition];
            }

            for($i=0; $i<$numberOfCols; $i++)
            {
                $matrix[$rowPosition][$i] = $matrix[$rowPosition][$i] / $divisor;
            }
        }

        return $matrix;
    }

    private function zeroOperation(array $matrix, $rowPosition, $zeroPosition, $subjectRow)
    {
        $numberOfCols = count($matrix[$rowPosition]);

        if($matrix[$rowPosition][$zeroPosition] !== 0)
        {
            $numberToSubtract = $matrix[$rowPosition][$zeroPosition];

            for($i=0; $i<$numberOfCols; $i++)
            {
                $matrix[$rowPosition][$i] = $matrix[$rowPosition][$i] - $numberToSubtract * $matrix[$subjectRow][$i];
            }
        }

        return $matrix;
    }

    private function removeIdentityMatrix(array $matrix)
    {
        $inverseMatrix = array();
        $matrixCount = count($matrix);

        for($i=0; $i<$matrixCount; $i++)
        {
            $inverseMatrix[$i] = array_slice($matrix[$i], $matrixCount);
        }

        return $inverseMatrix;
    }

    private function appendIdentityMatrixToMatrix(array $matrix, array $identityMatrix)
    {
        //TODO $matrix & $identityMatrix compliance validation (same number of rows/columns, etc)

        $augmentedMatrix = array();

        for($i=0; $i<count($matrix); $i++)
        {
            $augmentedMatrix[$i] = array_merge($matrix[$i], $identityMatrix[$i]);
        }

        return $augmentedMatrix;
    }

    public function identityMatrix($size)
    {
        //TODO validate $size

        $identityMatrix = array();

        for($i=0; $i<$size; $i++)
        {
            for($j=0; $j<$size; $j++)
            {
                if($i == $j)
                {
                    $identityMatrix[$i][$j] = 1;
                }
                else
                {
                    $identityMatrix[$i][$j] = 0;
                }
            }
        }

        return $identityMatrix;
    }
}

//******************** VYPOCET ********************//
//*************************************************************************//

$nazvy_aktiv = array('zlato','striebro','bitcoin', 'eurusd','oil','apple');

for($i = 0;$i<sizeof($nazvy_aktiv);$i++) {

    $sql_real = "SELECT DISTINCT realna,DATUM FROM `stranky` WHERE aktivum='" . $nazvy_aktiv[$i] . "' AND realna!=0
                    ORDER BY `stranky`.`datum` DESC LIMIT 10";
    $res_real = mysqli_query($connect, $sql_real);

    $real1 = $res_real->fetch_row()[0];
    $real2 = $res_real->fetch_row()[0];
    $real3 = $res_real->fetch_row()[0];
    $real4 = $res_real->fetch_row()[0];
    $real5 = $res_real->fetch_row()[0];

    $sql_predp = "SELECT DISTINCT hodnota,DATUM FROM `stranky` WHERE aktivum='" . $nazvy_aktiv[$i] . "' AND realna!=0
                    ORDER BY `stranky`.`datum` DESC LIMIT 10";
    $res_predp = mysqli_query($connect, $sql_predp);

    $predp1 = (($res_predp->fetch_row()[0] + $res_predp->fetch_row()[0]) / 2);
    $predp2 = (($res_predp->fetch_row()[0] + $res_predp->fetch_row()[0]) / 2);
    $predp3 = (($res_predp->fetch_row()[0] + $res_predp->fetch_row()[0]) / 2);
    $predp4 = (($res_predp->fetch_row()[0] + $res_predp->fetch_row()[0]) / 2);

    $hist1 = $real2;
    $hist2 = $real3;
    $hist3 = $real4;
    $hist4 = $real5;

    $Mt = Array(Array(1, 1, 1, 1), Array($hist1, $hist2, $hist3, $hist4), Array($predp1, $predp2, $predp3, $predp4));
    $M = Array(Array(1, $hist1, $predp1), Array(1, $hist2, $predp2), Array(1, $hist3, $predp3), Array(1, $hist4, $predp4));
    $y = Array(Array($real1), Array($real2), Array($real3), Array($real4));

    var_dump($Mt);
    var_dump($M);
    var_dump($y);

    $res = matrix_multiplication($Mt, $M);

try{
    $matrixLibrary = new MatrixLibrary();
    $inverseMatrix = $matrixLibrary->inverseMatrix($res);

    $res1 = matrix_multiplication($inverseMatrix, $Mt);

    $coefficients = matrix_multiplication($res1, $y);
}
catch(Exception $ex){
    echo "nastal problém vo výpočte, pravdepodobne neexistuje inverzná matica.";
    }



//******************** UKLADANIE KOEFICIENTOV DO DATABAZY ********************//
//*************************************************************************//

    $id = '';
    $intercept = $coefficients[0][0];
    $hodnota1 = $coefficients[1][0];
    $hodnota2 = $coefficients[2][0];
    $date = date('Y-m-d');


    $sql = "UPDATE koeficienty SET intercept='$intercept', hist = '$hodnota1', predp = '$hodnota2', datum_vypoctu = '$date' WHERE nazov = '".$nazvy_aktiv[$i]."'";

    $result = mysqli_query($connect,$sql);

    if ($connect->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

}

$connect->close();



