<?php

/**
 * Project: symfony-test.local;
 * File: VarDumperExt.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 02.12.2019, 18:41
 * Comment: VarDumperExt - Inherited and Modified Symfony VarDumper class
 */


namespace App\Helpers\Dumper;

use Symfony\Component\VarDumper\Caster\ReflectionCaster;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;
use Symfony\Component\VarDumper\Dumper\ContextualizedDumper;
use Symfony\Component\VarDumper\VarDumper;

class VarDumperExt extends VarDumper {

    private static $handler;

    public static function dump($var)
    {
        if (null === self::$handler) {
            $cloner = new VarCloner();
            $cloner->addCasters(ReflectionCaster::UNSET_CLOSURE_FILE_INFO);

            if (isset($_SERVER['VAR_DUMPER_FORMAT'])) {
                $dumper = 'html' === $_SERVER['VAR_DUMPER_FORMAT'] ? new HtmlDumperExt() : new CliDumper();
            } else {
                $dumper = \in_array(\PHP_SAPI, ['cli', 'phpdbg']) ? new CliDumper() : new HtmlDumperExt();
            }

            $dumper = new ContextualizedDumper($dumper, [new SourceContextProvider()]);

            self::$handler = function ($var) use ($cloner, $dumper) {
                $dumper->dump($cloner->cloneVar($var));
            };
        }

        return (self::$handler)($var);
    }

}