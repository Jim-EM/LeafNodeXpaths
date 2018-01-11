<?php

    $file =  simplexml_load_file($argv[1]);
    
    childMinder($file);

    function childMinder($thingToCheck, $string1 = '') {
        $string1 .= '/' . $thingToCheck->getName();
        foreach ($thingToCheck->children() as $child) {
            childMinder($child, $string1);
        }
       
        if ($thingToCheck->count() === 0) {
            echo $string1 . "\n";
        }
    }
