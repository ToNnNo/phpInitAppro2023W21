<?php

function validateParameter($parameter): void {
    if(!is_int($parameter)) {
        $message = sprintf('%s doit être un "integer", %s donné(e)', $parameter, gettype($parameter) );
        trigger_error($message, E_USER_ERROR);
    }
}

function exposant($number, $exp = 2): int {
    validateParameter($number);
    validateParameter($exp);

    return $number ** $exp;
}