<?php

/**
 * Project: symfony-test.local;
 * File: dump.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 02.12.2019, 22:21
 * Comment: 'ddx' - Alternative 'dd' function
 */

use App\Helpers\Dumper\VarDumperExt;

if (!function_exists('ddx')) {
    function ddx(...$vars)
    {
        foreach ($vars as $v) {
            VarDumperExt::dump($v);
        }

        die(1);
    }
}