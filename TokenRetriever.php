<?php
require_once('./lib/Token.php');
$meter = $_POST["meterNo"];
$from = date_parse_from_format('d-m-Y', $_POST["from"]);
$to = date_parse_from_format('d-m-Y', $_POST["to"]);

$newFrom = $from["year"] . "-" . $from["month"] . "-" . $from["day"];
$newTo = $to["year"] . "-" . $to["month"] . "-" . $to["day"];

//display tokens by meter and dates range
//this will be called each time user enters values 
//meter number, start date & end date they must be provided, not optional\


try {
    echo $token->displayTokens($meter, $newFrom, $newTo); //meter,startDate,endDate
} catch (Exception $e) {
    echo '<table class="table" width="20%"><tr><td style="text-align:center"><h4>Unknown Service Error</h4></td></tr></table>';
}
