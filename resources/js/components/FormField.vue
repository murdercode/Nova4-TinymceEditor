<template>
  <DefaultField :errors="errors" :field="currentField" :full-width-content="fullWidthContent"
                :show-help-text="showHelpText">
    <template #field>
      <editor
          :id="fieldId"
          v-model="value"
          :api-key="currentField.options.apiKey"
          :cloud-channel="currentField.options.cloudChannel ?? 6"
          :disabled="currentField.readonly"
          :init="currentField.options.init"
          :placeholder="currentField.name"
          :plugins="currentField.options.plugins"
          :toolbar="currentField.options.toolbar"
      />

    </template>
  </DefaultField>
</template>

<script>
import { DependentFormField, HandlesValidationErrors } from 'laravel-nova'
import Editor from '@tinymce/tinymce-vue'
import {uuid} from "@tinymce/tinymce-vue/lib/es2015/main/ts/Utils";

export default {
  mixins: [DependentFormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'options'],

  components: {
    editor: Editor
  },

  created () {
    this.setupProtectContent()
    this.setEditorTheme()
  },

  computed: {
    fieldId () {
      return this.field.attribute + '-' + uuid('nova-4-tinymce')
    }
  },

  methods: {
    uuid,
    setupProtectContent () {
      if (this.field.options.init.protect) {
        this.field.options.init.protect = this.field.options.init.protect.map((regex) => {
          const exp = regex.match(/^([/~@;%#'])(.*?)\1([gimsuy]*)$/)
          if (exp) {
            return new RegExp(exp[2], exp[3])
          }
          return new RegExp(regex.replace(/^\/+|\/+$/gm, '')) // remove leading and trailing slashes
        })
      }
    },

    setEditorTheme () {
      const selectedNovaTheme = localStorage.novaTheme

      if (typeof selectedNovaTheme !== 'undefined') {
        if (selectedNovaTheme === 'system') {
          this.setSystemMode()
        } else if (selectedNovaTheme === 'dark') {
          this.field.options.init.skin = 'oxide-dark'
          this.field.options.init.content_css = 'dark'
        } else {
          this.field.options.init.skin = 'oxide'
          this.field.options.init.content_css = 'default'
        }
      } else {
        this.setSystemMode()
      }
    },

    setSystemMode () {
      this.field.options.init.skin =
          window.matchMedia('(prefers-color-scheme: dark)').matches ||
          document.querySelector('html').classList.contains('dark')
            ? 'oxide-dark'
            : 'oxide'
      this.field.options.init.content_css =
          window.matchMedia('(prefers-color-scheme: dark)').matches ||
          document.querySelector('html').classList.contains('dark')
            ? 'dark'
            : 'default'
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill (formData) {
      formData.append(this.field.attribute, this.value || '')
    }
  }
}
</script>
