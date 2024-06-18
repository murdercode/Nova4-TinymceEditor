# Nova4 TinyMCE Editor

<p align="center">
<img src="https://github.com/murdercode/Nova4-TinymceEditor/raw/HEAD/art/banner.svg" width="100%" 
alt="Logo Nova4 TinyMce"></p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/murdercode/nova4-tinymce-editor.svg?style=flat-square)](https://packagist.org/packages/murdercode/nova4-tinymce-editor)
[![Code Style](https://img.shields.io/github/actions/workflow/status/murdercode/Nova4-TinymceEditor/fix-php-code-style-issues.yml?label=Code%20Style)](https://github.com/murdercode/Nova4-TinymceEditor/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Analyze](https://github.com/murdercode/Nova4-TinymceEditor/actions/workflows/phpstan.yml/badge.svg)](https://github.com/murdercode/Nova4-TinymceEditor/actions/workflows/phpstan.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/a6b48b887c69a5f91ee5/maintainability)](https://codeclimate.com/github/murdercode/Nova4-TinymceEditor/maintainability)
[![Total Downloads](https://img.shields.io/packagist/dt/murdercode/nova4-tinymce-editor.svg?style=flat-square)](https://packagist.org/packages/murdercode/nova4-tinymce-editor)
![License Mit](https://img.shields.io/github/license/murdercode/Nova4-TinymceEditor)
<!--[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/murdercode/nova4-tinymce-editor/run-tests?label=tests)](https://github.com/murdercode/nova4-tinymce-editor/actions?query=workflow%3Arun-tests+branch%3Amain)-->

## Introduction

Unleash creativity within Laravel Nova using the TinyMCE plugin, making content creation a breeze with its user-friendly
and dynamic editing capabilities.

## Features

* 📷 Upload images support *(BETA)*
* 🌙 Dark mode support
* 🔀 Switch between 5 or 6 versions of TinyMCE
* ❌ Can be disabled (by passing readonly() to make method)

## Extra

> [!IMPORTANT]
> Want some steroids for your TinyMCE? [Check out](https://github.com/The-3Labs-Team/tinymce-chatgpt-plugin) our new *
*ChatGTP for TinyMCE** plugin! 🚀🚀🚀

## Demo & Screenshots

<p align="center">
<img src="https://github.com/murdercode/Nova4-TinymceEditor/raw/HEAD/art/demo1.gif" width="100%" 
alt="Demo Nova4 TinyMce"></p>

## Versioning

This package follows the following versioning scheme:

* **v1.x** - TinyMCE 5 or 6
* **v0.x** - TinyMCE version 5 (deprecated)

## Prerequisites

- Laravel >= 9
- PHP >= 8.0
- Laravel Nova >= 4
- TinyMCE API Key ([get one here](https://www.tiny.cloud/))

# How to install

In the root of your Laravel installation launch:

```bash
composer require murdercode/nova4-tinymce-editor
```

Then publish the config:

```bash
php artisan vendor:publish --provider="Murdercode\TinymceEditor\FieldServiceProvider"
```

A file in `config/nova_tinymce_editor.php` will appear as follows (you can change the default values):

```php
<?php

return [
    'cloudChannel' => '6', // 5 or 6

    /**
     * Get your API key at https://www.tiny.cloud and put it here or in your .env file
     */
    'apiKey' => env('TINYMCE_API_KEY', ''),

    /**
     * The default skin to use.
     */
    'skin' => 'oxide-dark',

    /**
     * The default options to send to the editor.
     * See https://www.tiny.cloud/docs/configure/ for all available options (check for 5 or 6 version).
     */
    'init' => [
        'menubar' => false,
        'autoresize_bottom_margin' => 40,
        'branding' => false,
        'image_caption' => true,
        'paste_as_text' => true,
        'autosave_interval' => '20s',
        'autosave_retention' => '30m',
        'browser_spellcheck' => true,
        'contextmenu' => false,
        //'images_upload_url' => '/nova-vendor/murdercode/tinymce/upload', // Uncomment to enable image upload
    ],
    'plugins' => [
        'advlist',
        'anchor',
        'autolink',
        'autosave',
        'fullscreen',
        'lists',
        'link',
        'image',
        'media',
        'table',
        'code',
        'wordcount',
        'autoresize',
    ],
    'toolbar' => [
        'undo redo restoredraft | h2 h3 h4 |
                 bold italic underline strikethrough blockquote removeformat |
                 align bullist numlist outdent indent | link anchor table | code fullscreen spoiler',
    ],

    /**
     * Extra configurations for the editor.
     */
    'extra' => [
        'upload_images' => [
            'enabled' => false, // Uncomment to enable
            'folder' => 'images',
            'maxSize' => 2048, // KB
            'disk' => 'public',
        ],
    ],
];
```

In your `.env` file please add the key (get one [here](https://www.tiny.cloud/)):

```
TINYMCE_API_KEY=[YOUR_PRECIOUS_PRIVATE_KEY]
```

Please make sure that you have added domain in your tiny.cloud account list or you will get an error notice message.

## Register the Field

In your Nova/Resource.php add the field as following:

```php
<?php

use Murdercode\TinymceEditor\TinymceEditor;

class Article extends Resource
{
    //...
    public function fields(NovaRequest $request)
    {
        return [
            TinymceEditor::make(__('Content'), 'content')
                ->rules(['required', 'min:20'])
                ->fullWidth()
                ->help(__('The content of the article.')),
        ];
    }
}
                //...
```

## Enable Image Upload

<p align="center">
<img src="https://github.com/murdercode/Nova4-TinymceEditor/raw/HEAD/art/demo2.png" width="100%" 
alt="Demo Nova4 TinyMce"></p>

> [!WARNING]
> This feature is in BETA and can be unstable or contain bugs/security flaws. We provide it as is, without any warranty.
> For this reason, is disabled by default.

To enable image upload, you must publish the configuration file
with:

```bash
php artisan vendor:publish --provider="Murdercode\TinymceEditor\FieldServiceProvider"
```

then in your config
file `config/nova-tinymce-editor.php`:

```php
<?php

// Uncomment the following line
'images_upload_url' => '/nova-vendor/murdercode/tinymce/upload',

// Set the following to true
    'extra' => [
        'upload_images' => [
            'enabled' => false, // Uncomment to enable
            'folder' => 'images',
            'maxSize' => 2048, // KB
            'disk' => 'public',
        ],
    ],
```

Please be sure that `image` plugin and toolbar button are enabled in your config file.

## Protect code

You can to control what contents [should be protected](https://www.tiny.cloud/docs/tinymce/6/content-filtering/#protect)
from editing while it gets passed
into the editor. This is useful for example when you want to protect PHP code from been formatted.

To do this, you must publish the configuration file and add the following line:

```php
<?php

return [
'init' => [
        // ... Your awesome init config ...
         /**
         * Set what content should be protected while editing
         * This should be a regular expression
         * E.g "/<\?php.*?\?>/g" - Protect PHP code from been formatted
         */
         'protect' => []
];
//...
```

## Use Alternative CDN / Self Hosted scripts

TinyMCE allows you to use an alternative mirror for scripts. It will be useful if you want to use a non-cloud version (and avoid the new mechanism pricing of Tiny.cloud).

You can simply add in `app/Providers/NovaServiceProvider.php`:

```php

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        // TinyMCE Mirror
        Nova::script('custom', 'https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js');

        // ...
    }
}
```

TinyMCE will automatic check if there's a script and I'll ignore his script from tiny cloud.

## Upgrade from 1.0.x to 1.1.x

The transition to 1.1 involves the use of a new configuration layout compatible with the previous version.

However, if you want to use the new image upload and version change features, it is recommended that you make a
new `php artisan vendor:publish`.

## Upgrade from 0.x to 1.x

In `composer.json` change the version of the package to

`"murdercode/nova4-tinymce-editor": "^1.0"`

and run `composer update`.

Also, you must change the format of the plugin snippet in `nova-tinymce-editor` as follows:

*0.x*

```php
'plugins' => [
            'anchor advlist autolink autoresize autosave code fullscreen link lists image imagetools media
            paste wordcount',
        ],
```

*1.x*

```php
'plugins' => [
            'anchor',
            'advlist',
            // etc...
        ],
```

## Feedback and Support

Test, PR (also of this doc) are welcome.

