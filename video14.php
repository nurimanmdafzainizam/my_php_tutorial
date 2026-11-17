<?php

// variable scope

// local vars

function myFunc()
{
    $price = 10;
    echo $price;
}

// myFunc();
// echo $price;

function myFuncTwo($age)
{
    echo $age;
}

// my FuncTwo(25);
// echo $age;

// global variables

$name = 'mario';

//function sayHello(){
//    global $name;
//    $name = 'yoshi';
//    echo "hello$name";
// }

// say Hello();
// echo $name;

function sayBye($name)
{
    $name = 'wario';
    echo "bye $name";
}

sayBye($name);
echo $name;

?>

<!DOCTYPE html>
<html>

<head>
    <title>PHP Tutorials</title>
</head>

<body>

</body>

</html>