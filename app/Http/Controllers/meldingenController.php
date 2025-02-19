<?php

$action = $_POST['action'];
if($action == 'create') {   



//Variabelen vullen
$attractie = $_POST['attractie'];
if(empty($attractie))
{
    $errors[] = "Vul attractie-naam in.";
}
$capaciteit = $_POST['capaciteit'];
if(!is_numeric($capaciteit))
{
    $errors[] = "Vul voor capaciteit een geldig getal in.";
}
$melder = $_POST['melder'];
if(empty($melder))
{
    $errors[] = "Vul melder-naam in.";
}
$type = $_POST['type'];
if(empty($type))
{
    $errors[] = "Vul type-naam in.";
}
if(isset($_POST['prioriteit']))
{
    $prioriteit = 1;
}
else
{
    $prioriteit = 0;
}
$overig = $_POST['overig'];
if(isset($errors))
{
    var_dump($errors);
    die();
}

//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, type, melder, capaciteit, prioriteit, overige_info)
VALUES(:attractie, :type, :melder, :capaciteit, :prioriteit, :overige_info)";

//3. Prepare
$statement = $conn->prepare($query);



//4. Execute
$test = $statement->execute([
    ":attractie" => $attractie,
    ":type" => $type,
    ":melder" => $melder,
    ":capaciteit" => $capaciteit,
    ":prioriteit" => $prioriteit,
    ":overige_info" => $overig
]);


//ga terug naar index
header("Location: ../../../resources/views/meldingen/index.php?msg=Meldingopgeslagen");
}
