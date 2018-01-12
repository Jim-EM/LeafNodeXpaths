<?php
    
    $errorArray = [
        LIBXML_ERR_WARNING => 'Warning',
        LIBXML_ERR_ERROR => 'Error',
        LIBXML_ERR_FATAL => 'Fatal Error'
    ];
    
    if (!is_file($argv[1]) || !is_readable($argv[1])) {
        echo 'Cannot access this file, it might not be a file!' . "\n";
        exit(1);
    }

    libxml_use_internal_errors(true);
    $tree =  simplexml_load_file($argv[1]);
    $xmlErrors = libxml_get_errors();
    
    if (count($xmlErrors) > 0) {
        foreach ($xmlErrors as $xmlError){
            echo $errorArray[$xmlError->level] . ' in file ' . $xmlError->file . ' at Line: ' . $xmlError->line . ':' . $xmlError->column . ' ' . $xmlError->message . "\n";
        }
        exit(1);
    }
    
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
