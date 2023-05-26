<?php 

const ERROR = "error";
const INFO = "info";

function getLogFile() {
    return dirname(__DIR__).'/var/log/log.txt';
}

function createLog($level, $message, array $context) {
    $date = date_create();
    $horodatage = date_format($date, DATE_ISO8601);

    $contextToString = implode(', ', $context);

    return sprintf("[%s] %s: %s (%s)\r\n", $horodatage, $level, $message, $contextToString);
}

function error($message, array $context=[]) {
    $path = getLogFile();
    $log = createLog(ERROR, $message, $context);

    file_put_contents($path, $log, FILE_APPEND);

    // envoyer un mail
    $to = "smenut@dawan.fr";
    $subject = "[ERROR] App Bibliothèque";
    mail($to, $subject, $log);
}

function info($message, array $context=[]) {
    $path = getLogFile();
    $log = createLog(INFO, $message, $context);

    file_put_contents($path, $log, FILE_APPEND);
}