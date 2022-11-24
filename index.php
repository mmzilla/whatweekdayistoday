<?php

$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];

$monthNumber = ['Jan'=>1,'Feb'=>2,'Mar'=>3,'Apr'=>4,'May'=>5,'Jun'=>6,'Jul'=>7,'Aug'=>8,'Sep'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12];

if(checkdate($monthNumber[$month], $day, $year)){
    echo "Your Weekday is ".weekDay($day,$month,$year);
    echo "\r\n";
    echo "Your Weekday2 is ".weekDay2($day,$month,$year);
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

function weekDay2($day, $month, $year)
{
    
    $dayOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $monthNumber = ['Jan'=>1,'Feb'=>2,'Mar'=>3,'Apr'=>4,'May'=>5,'Jun'=>6,'Jul'=>7,'Aug'=>8,'Sep'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12];
    $monthAmount = [1=>31, 2=>28, 3=>31, 4=>30, 5=>31, 6=>30, 7=>31, 8=>31, 9=>30, 10=>31, 11=>30, 12=>31];

    $startYear = 1900;
    $leapYear = 0;

    //$yearSubtract = $year > $startYear?1:0;
    $yearSubtract = 0;
    $countYear = ($year - $startYear) - $yearSubtract;
    
    for($i=$startYear; $i<=$year; $i++){
        if((($i % 4) == 0) && ((($i % 100) != 0) || (($i %400) == 0))){
            $leapYear++;
        }  
    }

    if($monthNumber[$month] < 3){
        $leapYear--;
    }

    $dayInYear = ($countYear*365) + $leapYear;

    $dayInMonth = 0;
    $countMonth = ($monthNumber[$month] - 1);
    for($x = 1; $x <= $countMonth; $x++){
        $dayInMonth += $monthAmount[$x];
    }

    //$dayInMonth = ($monthNumber[$month] - 1) * 30;
    //echo "$leapYear $countYear ($day + $dayInMonth + $dayInYear)".($day + $dayInMonth + $dayInYear) ."--".($day + $dayInMonth + $dayInYear) % 7;
    $sumDate = ($day + $dayInMonth + $dayInYear) % 7;

    return $dayOfWeek[$sumDate];
}