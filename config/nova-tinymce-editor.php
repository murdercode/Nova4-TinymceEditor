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
