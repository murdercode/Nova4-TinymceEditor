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
        // 'images_upload_url' => '/nova-vendor/murdercode/tinymce/upload', // Uncomment this line if you want to enable images upload
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
                 align bullist numlist outdent indent | image link anchor table | code fullscreen spoiler',
    ],

    /**
     * Extra configurations for the editor.
     */
    'extra' => [
        'upload_images' => [
            'enabled' => false, // Set true for enable images local upload
            'folder' => 'images',
            'maxSize' => 2048, // KB
        ],
    ],
];
