let mix = require('laravel-mix')
let path = require('path')

require('./nova.mix')
mix.disableNotifications()

mix
  .setPublicPath('dist')
  .js('resources/js/field.js', 'js')
  .vue({ version: 3 })
  .nova('murdercode/nova4-tinymce-editor')
