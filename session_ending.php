<?php
/*This is used when the user selects Sign Out
/// Clears the session details for logged in users*/

// Initialize the session.
// If you are using session_name("something"), don't forget it now!

    session_start();
    session_destroy();
    unset($_SESSION);
    session_regenerate_id(true);
    header('LOCATION: login.html');

?>