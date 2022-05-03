# Nova4 TinyMCE Editor

I'm proud to present a simple wrapper that allows you to use the excellent **TinyMCE Editor(v6)** within Larvale Nova 4. *Now with Dark mode*

![](https://s10.gifyu.com/images/2022-04-21-12.44.26.gif)

# Prerequisites
- Laravel 9
- Laravel Nova 4
- TinyMCE API Key ([get one here](https://www.tiny.cloud/))

## How to install

In the root of your Laravel installation launch:
```bash
composer require murdercode/nova4-tinymce-editor
```

Then publish the config:
```bash
php artisan vendor:publish --provider="Murdercode\TinymceEditor\FieldServiceProvider"
```

A file in _config/nova_tinymce_editor.php_ will appear:

```php
<?php

return [
        'init' => [
            'menubar' => false,
            'autoresize_bottom_margin' => 40,
            'branding' => false,
            'image_caption' => true,
            'paste_as_text' => true,
            'paste_word_valid_elements' => 'b,strong,i,em,h2',
        ],
        'plugins' => [
            'anchor advlist autolink autoresize autosave code fullscreen link lists image imagetools media
            paste wordcount',
        ],
        'toolbar' => [
            'undo redo | formatselect |
                 bold italic underline strikethrough blockquote removeformat |
                 align bullist numlist outdent indent | link anchor table media insertmedialibrary | code restoredraft fullscreen',
        ],
        
        'apiKey' => env('TINYMCE_API_KEY', ''),
];
```

In your **.env** file please add the key:
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
                ->help(__('The content of the article.')),
        ];
    }
}
                //...
```

## Feedback and Support
Test, PR (also of this doc) are welcome.

