<?php

    $tree =  simplexml_load_file($argv[1]);
    
    recurseChildren($tree);

    function recurseChildren($node, $pathString = '') {
        $pathString .= '/' . $node->getName();
        foreach ($node->children() as $child) {
            recurseChildren($child, $pathString);
        }
       
        if ($node->count() === 0) {
            echo $pathString . "\n";
        }
    }
