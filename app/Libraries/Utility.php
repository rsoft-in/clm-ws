<?php

namespace App\Libraries;

class Utility
{
    public function guid($opt = true)
    {
        mt_srand((float) microtime() * 10000); // optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45); // "-"
        $left_curly = $opt ? chr(123) : ""; // "{"
        $right_curly = $opt ? chr(125) : ""; // "}"
        $uuid = $left_curly . substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen . substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen . substr($charid, 20, 12) . $right_curly;
        return trim($uuid, '{}');
    }
}
