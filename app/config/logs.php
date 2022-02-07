<?php
// Error/Exception engine, always use E_ALL
error_reporting(E_ALL); 
// always use TRUE
ini_set('ignore_repeated_errors', TRUE); 
// Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment
ini_set('display_errors', FALSE); 
// Error/Exception file logging engine.
ini_set('log_errors', TRUE); 
ini_set("error_log", "logs/error.log");
