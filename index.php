<?php

use FabianMichael\ImageKit\OptimizerChainFactory;
use Kirby\Cms\App as Kirby;
use Kirby\Image\Darkroom;

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('fabianmichael/imagekit', [
    'options' => [
        'optimize' => false,
    ],
    'components' => [
        'thumb' => function (Kirby $kirby, string $src, string $template, array $options) {
            $root = $kirby->nativeComponent('thumb')($kirby, $src, $template, $options);

            if (option('fabianmichael.imagekit.optimize') === true) {
                $optimizerChain = OptimizerChainFactory::create($options);
                $optimizerChain->optimize($root);
            }

            return $root;
        }
    ],
    'hooks' => [
        'system.loadPlugins:after' => function () {
            Darkroom::$types['im'] = FabianMichael\ImageKit\Image\Darkroom\ImageMagick::class;
        }
    ]
]);
