<?php

// indexed arrays

$peopleOne = ['shaun', 'crystal', 'ryu'];

//echo $peopleOne[1];

$peopleTwo = array('amad', 'icad', 'nish');

//echo $peopleTwo[1];

$ages = [21, 19, 23];
//print_r($ages);

$ages[1] = 25;
//print_r($ages);

$ages[] = 31;
//print_r($ages);

array_push($ages, 70);
//print_r($ages);

//echo count($ages);

$peopleThree = array_merge($peopleOne, $peopleTwo);
//print_r($peopleThree);

// associative arrays (key & value pairs)

$ninjasOne = ['shaun' => 'black', 'crystal' => 'orange', 'muxxy' => 'brown'];
//echo $ninjasOne['crystal'];
print_r($ninjasOne);

// comparisons booleans (true or false)

//echo true; "1"
//echo false; ""

// numbers 

//echo 5 < 10;
//echo 5 > 10;
//echo 5 == 10;
//echo 10 == 10;
echo 5 != 10;

?>

<!DOCTYPE html>
<html>

<head>
    <title>PHP Tutorials</title>
</head>

<body>

</body>

</html>