# Nova4 TinyMCE Editor

[![Latest Version on Packagist](https://img.shields.io/packagist/v/murdercode/nova4-tinymce-editor.svg?style=flat-square)](https://packagist.org/packages/murdercode/nova4-tinymce-editor)
[![Code Style](https://img.shields.io/github/actions/workflow/status/murdercode/Nova4-TinymceEditor/fix-php-code-style-issues.yml?label=Code%20Style)](https://github.com/murdercode/Nova4-TinymceEditor/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Analyze](https://github.com/murdercode/Nova4-TinymceEditor/actions/workflows/phpstan.yml/badge.svg)](https://github.com/murdercode/Nova4-TinymceEditor/actions/workflows/phpstan.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/a6b48b887c69a5f91ee5/maintainability)](https://codeclimate.com/github/murdercode/Nova4-TinymceEditor/maintainability)
[![Total Downloads](https://img.shields.io/packagist/dt/murdercode/nova4-tinymce-editor.svg?style=flat-square)](https://packagist.org/packages/murdercode/nova4-tinymce-editor)
![License Mit](https://img.shields.io/github/license/murdercode/Nova4-TinymceEditor)
<!--[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/murdercode/nova4-tinymce-editor/run-tests?label=tests)](https://github.com/murdercode/nova4-tinymce-editor/actions?query=workflow%3Arun-tests+branch%3Amain)-->

I'm proud to present a simple wrapper that allows you to use the excellent TinyMCE Editor within Laravel Nova 4.

* Dark mode support
* Switch between 5 or 6 version of TinyMCE
* Can be disabled (passing `readonly()` to `make` method)

### Todo

* Support for upload images
* Support for local and cdn script

🚀🚀🚀 Want some steroids for your TinyMCE? [Check out](https://github.com/The-3Labs-Team/tinymce-chatgpt-plugin) our new *
*ChatGTP for TinyMCE** plugin!

## Demo & Screenshots

![](https://s4.gifyu.com/images/2022-10-06-12.34.13.gif)

## Versioning

This package follows the following versioning scheme:

* **v2.x** - TinyMCE 6 or 5 (new config, self hosted and more)
* **v1.x** - TinyMCE 6 (deprecated)
* **v0.x** - TinyMCE version 5 (deprecated)

## Prerequisites

- Laravel >= 9
- PHP >= 8.0
- Laravel Nova >= 4
- TinyMCE API Key ([get one here](https://www.tiny.cloud/))

# How to install

Please note that this how-to is for **TinyMCE 6**. For _TinyMCE 5_, please see the *v.0.* branch.

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
                 align bullist numlist outdent indent | link anchor table | code fullscreen',
        ],
        'apiKey' => env('TINYMCE_API_KEY', ''),
];
```

In your `.env` file please add the key:

```
TINYMCE_API_KEY=[YOUR_PRECIOUS_PRIVATE_KEY]
```

**Please make sure** that you have added domain in your tiny.cloud account list.

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

