<template>
  <DefaultField :field="currentField" :errors="errors" :show-help-text="showHelpText" :full-width-content="fullWidthContent">
    <template #field>
      <editor
          :id="currentField.attribute"
          :cloud-channel="6"
          v-model="value"
          :api-key="currentField.options.apiKey"
          :init="currentField.options.init"
          :plugins="currentField.options.plugins"
          :toolbar="currentField.options.toolbar"
          :placeholder="currentField.name"
      />
    </template>
  </DefaultField>
</template>

<script>
import { DependentFormField, HandlesValidationErrors } from "laravel-nova";
import Editor from "@tinymce/tinymce-vue";

export default {
  mixins: [DependentFormField, HandlesValidationErrors],

  props: ["resourceName", "resourceId", "options"],

  components: {
    editor: Editor,
  },

  created() {
    this.setEditorTheme();
  },

  methods: {
    setEditorTheme() {
        const selectedNovaTheme = localStorage.novaTheme;

        if (typeof selectedNovaTheme !== 'undefined') {
            if (selectedNovaTheme == 'system') {
                this.setSystemMode();
            } else if (selectedNovaTheme == 'dark') {
                this.field.options.init.skin = 'oxide-dark';
                this.field.options.init.content_css = 'dark';
            } else {
                this.field.options.init.skin = 'oxide';
                this.field.options.init.content_css = 'default';
            }
        } else {
            this.setSystemMode();
        }
    },

    setSystemMode() {
      this.field.options.init.skin =
        window.matchMedia("(prefers-color-scheme: dark)").matches ||
        document.querySelector("html").classList.contains("dark")
          ? "oxide-dark"
          : "oxide";
      this.field.options.init.content_css =
        window.matchMedia("(prefers-color-scheme: dark)").matches ||
        document.querySelector("html").classList.contains("dark")
          ? "dark"
          : "default";
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || "");
    },
  },
};
</script>
