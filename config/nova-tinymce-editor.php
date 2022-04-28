<?php

return [
        'init' => [
            'menubar' => false,
            'autoresize_bottom_margin' => 40,
            'branding' => false,
            'image_caption' => true,
            'paste_as_text' => true,
            'paste_word_valid_elements' => 'b,strong,i,em,h1,h2',
        ],
        'plugins' => [
            'advlist autolink lists link image imagetools media',
            'paste code wordcount autoresize table',
        ],
        'toolbar' => [
            'undo redo | formatselect forecolor backcolor |
                 bold italic underline strikethrough blockquote removeformat |
                 align bullist numlist outdent indent | link table media insertmedialibrary | code',
        ],
        'apiKey' => env('TINYMCE_API_KEY', ''),
];