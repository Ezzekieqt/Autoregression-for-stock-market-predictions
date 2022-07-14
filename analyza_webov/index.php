<?php
include_once "database.php";

$nextMonday = date('Y-m-d', strtotime('next week Monday'));
$lastMonday = date('Y-m-d', strtotime('Last Monday'));
$notFound = 0;
$sql = "SELECT hodnota FROM predpovede WHERE predpoved_na='".$nextMonday."' ORDER BY nazov";

$res = mysqli_query($connect, $sql);
if($res){
    $row1 = mysqli_fetch_array($res);
    $row2 = mysqli_fetch_array($res);
    $row3 = mysqli_fetch_array($res);
    $row4 = mysqli_fetch_array($res);
    $row5 = mysqli_fetch_array($res);
    $row6 = mysqli_fetch_array($res);
}
else{
    $notFound = 1;
}


    $sql_last = "SELECT DISTINCT realna FROM `stranky` WHERE datum='".$lastMonday."' ORDER by aktivum";
$res_last = mysqli_query($connect, $sql_last);
if($res_last===true){
    $r1 = mysqli_fetch_array($res_last);
    $r2 = mysqli_fetch_array($res_last);
    $r3 = mysqli_fetch_array($res_last);
    $r4 = mysqli_fetch_array($res_last);
    $r5 = mysqli_fetch_array($res_last);
    $r6 = mysqli_fetch_array($res_last);
}
else{
    $notFound = 1;
}

if($res_last===true && $res===true){
    $ch1 = round((($row1[0] / $r1[0])-1)*100,2);
    $ch2 = round((($row2[0] / $r2[0])-1)*100,2);
    $ch3 = round((($row3[0] / $r3[0])-1)*100,2);
    $ch4 = round((($row4[0] / $r4[0])-1)*100,2);
    $ch5 = round((($row5[0] / $r5[0])-1)*100,2);
    $ch6 = round((($row6[0] / $r6[0])-1)*100,2);
}
else{
    $notFound = 1;
}




?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="David Zabak">
    <link rel="icon" href="../analyza_webov/bootstrap/kroko.png">

    <title>Stockligator</title>

    <!-- Bootstrap core CSS -->
    <link href="../analyza_webov/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="styles.css" rel="stylesheet">
</head>

<body>

<header>
    <div class="collapse" id="navbarHeader" style="background-color: #339966">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">O programe</h4>
                    <p class="text" style="color: white">Stockligator je program vytvorený za účelom mojej bakalárskej práce. Jeho cieľom je využívať rozličné techniky sledovania pohybov na burze a pomocou nich predpovedať cenu rozličných aktív.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Kontakt</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Follow on Twitter</a></li>
                        <li><a href="#" class="text-white">Like on Facebook</a></li>
                        <li><a href="#" class="text-white">Email me</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark box-shadow" style="background-color: #339966">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img src="../analyza_webov/bootstrap/kroko.png" alt="kroko" width="10%" height="10%">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Stockligator</h1>
            <p class="lead text-muted">They say, you can never predict future. I told them, we are the future. We can control our own decisions for tomorrow. If we unite, we can form the whole future of humankind.</p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="../analyza_webov/bootstrap/gold.jpeg" alt="Card image cap" style="width: 97.3%; height: 80%">
                        <div class="card-body">
                            <p class="card-text"><q>The desire of gold is not for gold. It is for the means of freedom and benefit.</q><br> -Raplh Waldo Emerson</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#gold-modal">View</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="../analyza_webov/bootstrap/silver.jpg" alt="Card image cap" style="width: 100%; height: 80%">
                        <div class="card-body">
                            <p class="card-text"><q>Silver, gold - I don't discriminate! I like sparkly things.</q><br> -Charlaine Harris</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#silver-modal">View</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="../analyza_webov/bootstrap/bitcoin.png" alt="Card image cap" style="width: 74.5%; height: 100%; margin-left: auto; margin-right: auto;">
                        <div class="card-body">
                            <p class="card-text"><q>Bitcoin is like anything else: it's worth what people are willing to pay for it.</q><br> - Stanley Druckenmiller</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#bitcoin-modal">View</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="../analyza_webov/bootstrap/eurusd.jpg" alt="Card image cap" style="width: 100%; height: 100%">
                        <div class="card-body">
                            <p class="card-text"><q>Money cannot buy happiness; it can, however, rent it.</q><br> - Somebody</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#eurusd-modal">View</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="../analyza_webov/bootstrap/oil.jpg" alt="Card image cap" style="width: 66.5%; height: 80%; margin-left: auto; margin-right: auto;">
                        <div class="card-body">
                            <p class="card-text"><q>First off, the crude oil market, unlike every other commodity in america, is virtually unregulated.</q>- Peter Defazio</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#oil-modal">View</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="../analyza_webov/bootstrap/aapl.png" alt="Card image cap" style="width: 66.5%; height: 80%; margin-left: auto; margin-right: auto;">
                        <div class="card-body">
                            <p class="card-text"><q>Your time is limited, so don't waste it living someone else's life.</q><br> - Steve Jobs</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#apple-modal">View</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gold Modal -->

    <div class="container">

        <div class="modal fade" id="gold-modal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">
                        <p>       </p>

                        <table>
                            <tr>
                                <td>Next monday high prediction: </td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $row6[0];} else{echo "Chýbajú dáta z minulého týždňa";} ?></strong></td>
                            </tr>
                            <tr>
                                <td>Last monday high price: </td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $r6[0];} else{echo "Chýbajú dáta z minulého týždňa";} ?></strong></td>
                            </tr>
                            <tr>
                                <td>Change:</td>
                                <td></td>
                                <td><?php if (!$notFound) {echo $ch6."%";} else{echo "Chýbajú dáta z minulého týždňa";}  ?></td>
                            </tr>
                        </table>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Silver Modal -->

    <div class="container">

        <div class="modal fade" id="silver-modal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>Next monday high prediction: </td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $row5[0];} else{echo "Chýbajú dáta z minulého týždňa";}?></strong></td>
                            </tr>
                            <tr>
                                <td>Last monday high price:</td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $r5[0];} else{echo "Chýbajú dáta z minulého týždňa";}?></strong></td>
                            </tr>
                            <tr>
                                <td>Change:</td>
                                <td></td>
                                <td><?php if (!$notFound) {echo $ch5."%";} else{echo "Chýbajú dáta z minulého týždňa";}  ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Bitcoin Modal -->

    <div class="container">

        <div class="modal fade" id="bitcoin-modal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>Next monday high prediction: </td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $row2[0];} else{echo "Chýbajú dáta z minulého týždňa";}?></strong></td>
                            </tr>
                            <tr>
                                <td>Last monday high price:</td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $r2[0];} else{echo "Chýbajú dáta z minulého týždňa";} ?></strong></td>
                            </tr>
                            <tr>
                                <td>Change:</td>
                                <td></td>
                                <td><?php if (!$notFound) {echo $ch2."%";} else{echo "Chýbajú dáta z minulého týždňa";}  ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Eurusd Modal -->

    <div class="container">

        <div class="modal fade" id="eurusd-modal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>Next monday high prediction: </td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $row3[0];} else{echo "Chýbajú dáta z minulého týždňa";}?></strong></td>
                            </tr>
                            <tr>
                                <td>Last monday high price:</td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $r3[0];} else{echo "Chýbajú dáta z minulého týždňa";} ?></strong></td>
                            </tr>
                            <tr>
                                <td>Change:</td>
                                <td></td>
                                <td><?php if (!$notFound) {echo $ch3."%";} else{echo "Chýbajú dáta z minulého týždňa";}  ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Oil Modal -->

    <div class="container">

        <div class="modal fade" id="oil-modal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>Next monday high prediction: </td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $row4[0];} else{echo "Chýbajú dáta z minulého týždňa";}?></strong></td>
                            </tr>
                            <tr>
                                <td>Last monday high price:</td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $r4[0];} else{echo "Chýbajú dáta z minulého týždňa";} ?></strong></td>
                            </tr>
                            <tr>
                                <td>Change:</td>
                                <td></td>
                                <td><?php if (!$notFound) {echo $ch4."%";} else{echo "Chýbajú dáta z minulého týždňa";}  ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Apple Modal -->

    <div class="container">

        <div class="modal fade" id="apple-modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>Next monday high prediction: </td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $row1[0];} else{echo "Chýbajú dáta z minulého týždňa";}?></strong></td>
                            </tr>
                            <tr>
                                <td>Last monday high price:</td>
                                <td></td>
                                <td><strong style="color: grey"><?php if (!$notFound) {echo $r1[0];} else{echo "Chýbajú dáta z minulého týždňa";} ?></strong></td>
                            </tr>
                            <tr>
                                <td>Change:</td>
                                <td></td>
                                <td><?php if (!$notFound) {echo $ch1."%";} else{echo "Chýbajú dáta z minulého týždňa";}  ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>David Zabak</p>
    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../analyza_webov/bootstrap/jquery-slim.min.js"><\/script>')</script>
<script src="../analyza_webov/bootstrap/popper.min.js"></script>
<script src="../analyza_webov/bootstrap/bootstrap.min.js"></script>
<script src="../analyza_webov/bootstrap/holder.min.js"></script>
<script src="../analyza_webov/bootstrap/modal.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>

