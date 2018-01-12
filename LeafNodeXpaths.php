<?php

    if (!is_file($argv[1]) || !is_readable($argv[1])) {
        echo 'Cannot access this file, it might not be a file!' . "\n";
        exit 1;
    }

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
