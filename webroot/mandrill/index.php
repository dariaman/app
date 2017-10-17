<?php
require_once 'src/Mandrill.php'; 

try {
    $mandrill = new Mandrill('r0ncv3NLtPdqNWQaTlxaEQ');
    $result = $mandrill->users->info();
    echo "<pre>";
    print_r($result);
    
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Invalid_Key - Invalid API key
    throw $e;
}
?>
