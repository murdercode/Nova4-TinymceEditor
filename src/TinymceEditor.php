<?php

namespace Murdercode\TinymceEditor;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\SupportsDependentFields;

class TinymceEditor extends Field
{
    use SupportsDependentFields;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'tinymce-editor';

    /**
     * Indicates if the element should be shown on the index view.
     *
     * @var bool
     */
    public $showOnIndex = false;

    public function __construct(string $name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute);
        $this->resolveCallback = $resolveCallback;

        $this->withMeta([
            'options' => config('nova-tinymce-editor', []),
        ]);
    }

    public function options($options)
    {
        $inlineOptions = $this->meta['options'] ?? [];

        return $this->withMeta([
            'options' => array_merge($inlineOptions, $options),
        ]);
    }
}
