<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = (new Finder())
    ->in(__DIR__)
    ->exclude([
        'resources',
        'storage',
        'tools',
    ]);

return (new Config())
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder);
