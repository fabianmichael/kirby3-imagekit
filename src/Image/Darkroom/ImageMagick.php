<?php

namespace FabianMichael\ImageKit\Image\Darkroom;

use Kirby\Image\Darkroom\ImageMagick as OriginalImageMagick;

class ImageMagick extends OriginalImageMagick
{
    /**
     * Creates the convert command with the right path to the binary file
     * and converts the image to sRGB colorspace.
     *
     * @param string $file
     * @param array $options
     * @return string
     */
    protected function convert(string $file, array $options): string
    {
        $profile = dirname(__DIR__, 3) . '/resources/sRGB2014.icc';
        return sprintf($options['bin'] . ' "%s" -profile "%s"', $file, $profile);
    }


    /**
     * Removes all metadata from the image, but keep the icc profile.
     *
     * @param string $file
     * @param array $options
     * @return string
     */
    protected function strip(string $file, array $options): string
    {
        return '+profile "!icc,*"';
    }
}
