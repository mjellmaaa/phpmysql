<?php
    $dogs = array (
        array("husky", "siberia", 20),
        array("bulldog", "england", 15),
    array("pitbull", "USA",25)
    );

    //echo $dogs[0][0] . ":origin " . $dogs[0][1] . ", life span: " . $dogs[0][2]. ".<br>";

    //echo $dogs[1][0] . ":origin " . $dogs[1][1] . ", life span: " . $dogs[1][2]. ".<br>";

    //echo $dogs[2][0] . ":origin " . $dogs[2][1] . ", life span: " . $dogs[2][2]. ".<br>";

    for($row = 0;$row < 3; $row++){
        echo "<p><b>Row number $row<b></p>";
        echo "<ul>";
        for ($col = 0; $col<3; $col++){
            echo "<li>". $dogs[$row][$col]."</li>";
        }
        echo "</ul>";
    }

    $arrays = array(
        array(1,2,3),
        array(1,2,3),
        array(1,2,3),
    );

    for ($i = 1; $i < 4; $i++){
        for($j = 1;$j < 4; $j++){
            echo "array: $i element: $j <br>";
        } 
    }

?>