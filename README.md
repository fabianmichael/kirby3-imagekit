# ImageKit for Kirby 3

> This is not directly related for ImageKit for Kirby 2, but based on the same idea of improving Kirby’s built-in image processing capabilities.

Adds support for color-managed thumbnails to Kirby 3. It does so by converting all thumbnails to sRGB color space and embeds an ICC v2 profile for best compatibility across devices and screens. It also provides basic optional image optimization.

⚠️ This is an experimental plugin and probably far from being complete. As Kirby’s built-in image processing will probably get an overhaul in the foreseeable future, this might also be just an intermediate solution.

****

## Installation

### Download

Download and copy this repository to `/site/plugins/imagekit`.

### Git submodule

```
git submodule add https://github.com/fabianmichael/kirby3-imagekit.git site/plugins/imagekit
```

### Composer

Composer setup is not yet available during early development.

## Setup

⚠️ As the GD library does not support color management, you need to use the `im` driver in order to make this plugin work.

Your server needs to have a recent version of ImageMagick available on the command line that was compiled with LittleCMS for color management support. You can check this by logging into to server via SSH and type `convert --version` (assuming, that ImageMagick is in your PATH). This should give you a result like this:

```
Version: ImageMagick 7.0.11-14 Q16 x86_64 2021-05-31 https://imagemagick.org
Copyright: (C) 1999-2021 ImageMagick Studio LLC
License: https://imagemagick.org/script/license.php
Features: Cipher DPC HDRI Modules OpenMP(5.0)
Delegates (built-in): bzlib fontconfig freetype gslib heic jng jp2 jpeg lcms lqr ltdl lzma openexr png ps tiff webp xml zlib
```

If you can spot `lcms` in the Delegates line, you’re good to go! :-)

If you also want to optimize your images for filesize, please also install the corresponding command line tools. This will probably not be possible in most shared hosting environments. ImageKit currently relies on a custom configuration of the [spatie/image-optimizer](https://github.com/spatie/image-optimizer#optimization-tools) package for that purpose, please refer to their installing instructions at <https://github.com/spatie/image-optimizer#optimization-tools>.

Delete the conents of your `media` folder to clear existing thumbnails.

## Options

| Option | Type   | Required | Default                | Description                                        |
|:-------|:-------|:---------|:-----------------------|:---------------------------------------------------|
| optimize | bool | `false` | `false` | Will optimize your images by using a bunch of command-line tools, which need to be installed separately. |

## License

MIT

## Credits

Written by [Fabian Michael](https://fabianmichael.de) and inspired by input from [Florian Karsten](https://floriankarsten.com/) and the Kirby community.
