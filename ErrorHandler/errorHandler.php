<?php


function customErrorHandler($errno, $errstr, $errfile, $errline) {
    // Generate a log message for the error
    $errorMessage = "Error [$errno]: $errstr in $errfile on line $errline";
    error_log($errorMessage);

    // Redirect the user to the error page
    header("Location: ../../ErrorHandler/error.php");
    exit();
    
    
}

// Set the error handler to the custom function
set_error_handler("customErrorHandler");


// Trigger an error by calling a non-existent function
//echo $undefinedVariable;
