<?php

    // Start the session (this line should be included before using session functions)
    session_start();

    // Unset all session variables
    session_unset();

    // Optionally destroy the session (commented out in your case)
    // session_destroy();

    // Redirect to the login page (or home page)
    header('Location: index.php');
    exit;

