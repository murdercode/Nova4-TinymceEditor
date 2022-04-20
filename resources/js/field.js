import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-tinymce-editor', IndexField)
  app.component('detail-tinymce-editor', DetailField)
  app.component('form-tinymce-editor', FormField)
})
