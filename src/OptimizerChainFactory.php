<?php

namespace FabianMichael\ImageKit;

use Spatie\ImageOptimizer\OptimizerChain;
use Spatie\ImageOptimizer\Optimizers\Gifsicle;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;
use Spatie\ImageOptimizer\Optimizers\Optipng;
use Spatie\ImageOptimizer\Optimizers\Pngquant;

class OptimizerChainFactory
{
    public static function create(array $options = []): OptimizerChain
    {
        return (new OptimizerChain())
            ->addOptimizer(new Jpegoptim(array_filter([
                '--max=' . ($options['jpegoptim.max'] ?? $options['quality'] ?? 85),
                '--strip-com',
                '--strip-exif',
                '--strip-iptc',
                (($options['jpegtran.interlace'] ?? $options['interlace'] ?? false) ? '--all-progressive' : null),
            ])))

            ->addOptimizer(new Pngquant(array_filter([
                '--quality=' . ($options['pngquant.quality'] ?? $options['quality'] ?? 85),
                '--force',
                '--skip-if-larger',
                '--speed 3',
                // ($options['pngquant.colors'] ?? null),
                // (isset($options['pngquant.posterize']) ? ('--posterize ' . $options['pngquant.posterize']) : null),
            ])))

            ->addOptimizer(new Optipng(array_filter([
                '-i' . (($options['interlace'] ?? false) ? 1 : 0),
                '-o2',
                '-quiet',
            ])))

            ->addOptimizer(new Gifsicle(array_filter([
                '-b', // override original file
                '-O3',
            ])));
    }
}
