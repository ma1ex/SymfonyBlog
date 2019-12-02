<?php

/**
 * Project: symfony-test.local;
 * File: HtmlDumperExt.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 02.12.2019, 22:09
 * Comment: HtmlDumperExt - Inherited and Modified Symfony HtmlDumper class
 */


namespace App\Helpers\Dumper;

use Symfony\Component\VarDumper\Dumper\HtmlDumper;

class HtmlDumperExt extends HtmlDumper {

    protected static $themes = [
        'alter' => [
            'default' => 'background:#202020; color:#FF7895; line-height:1.2rem; font:18px Consolas, monospace; word-wrap: break-word; white-space: pre-wrap; position:relative; z-index:99999; word-break: break-all',
            'num' => 'font:18px Consolas; font-weight:normal; color:#F86D37',
            'const' => 'font-weight:normal color:#8AE8DC',
            'str' => 'font:18px Consolas; font-weight:normal; color:#F0F96B;',
            'note' => 'color:#50FA7B',
            'ref' => 'color:#8AE8DC',
            'public' => 'color:#47ACFC',
            'protected' => 'color:#47ACFC',
            'private' => 'color:#47ACFC',
            'meta' => 'color:#B729D9',
            'key' => 'color:#8AE8DC',
            'index' => 'color:#50FA7B',
            'ellipsis' => 'color:#CC7832',
            'ns' => 'user-select:none;',
        ],
    ];

    public function __construct($output = null, string $charset = null, int $flags = 0) {
        parent::__construct($output, $charset, $flags);
        $this->setTheme('alter');
    }
}