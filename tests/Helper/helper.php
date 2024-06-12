<?php


namespace IRFANEM\TELE_BLAST\App {

    function header(string $value){

        echo $value;

    }

}


namespace IRFANEM\TELE_BLAST\Service {

    function setcookie(string $name, string $value)
    {
        echo "$name: $value";
    }

}