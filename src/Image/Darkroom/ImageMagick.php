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
     * Returns additional default parameters for imagemagick
     *
     * @return array
     */
    protected function defaults(): array
    {
        return parent::defaults() + [
            'sharpen' => 0,
        ];
    }

    /**
     * Makes sure to not process too many images at once
     * which could crash the server
     *
     * @param string $file
     * @param array $options
     * @return string
     */
    protected function save(string $file, array $options): string
    {
        $sharpen = $options['sharpen'] > 0
            ? sprintf('-sharpen 0x%F ', $options['sharpen'])
            : '';

        return $sharpen . parent::save($file, $options);
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
