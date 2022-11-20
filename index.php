<?php

$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];

$monthNumber = ['Jan'=>1,'Feb'=>2,'Mar'=>3,'Apr'=>4,'May'=>5,'Jun'=>6,'Jul'=>7,'Aug'=>8,'Sep'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12];

if(checkdate($monthNumber[$month], $day, $year)){
    echo "Your Weekday is ".weekDay($day,$month,$year);
}else{
    echo "Incorrect date!!";
}


function weekDay($day, $month, $year)
{
    /*
        in case of year 
        18xx $yearAdd = 3
        19xx $yearAdd = 1
        20xx $yearAdd = 0
        21xx $yearAdd = 5
    */
    $yearAdd = $year >= 2000 ? 0 : 1;
    
    $monthSubtract = 0;
    if( ((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0))) && ($month=='Jan' || $month=='Feb')){
        $monthSubtract = 1;
    }    
    
    $dayOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
       
    $monthCode = ['Jan'=>6,'Feb'=>2,'Mar'=>2,'Apr'=>5,'May'=>0,'Jun'=>3,'Jul'=>5,'Aug'=>1,'Sep'=>4,'Oct'=>6,'Nov'=>2,'Dec'=>4];
    
    $monthValue = $monthCode[$month] - $monthSubtract;
    
    $last2DigitYear = intval(substr($year,-2));
    
    $sumDate = ($day + $monthValue + ((($last2DigitYear + floor($last2DigitYear/4)) % 7) + $yearAdd)) % 7;
    
    return $dayOfWeek[$sumDate];
}