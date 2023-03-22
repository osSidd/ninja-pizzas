<?php
    declare(strict_types=1);
//    echo 'Hello World'

    function variable(int $z = 0): int{
        $x = [2,3,5];
        $y = ['a','b'];
        print_r($x + $y);
        echo $z;
        return 234234;
    }

    variable(234);


?>