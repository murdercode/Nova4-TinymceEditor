<template>
  <DefaultField :field="field" :errors="errors" :show-help-text="showHelpText">
    <template #field>
      <editor
          :id="field.attribute"
          :cloud-channel="6"
          v-model="value"
          :api-key="field.options.apiKey"
          :init="field.options.init"
          :plugins="field.options.plugins"
          :toolbar="field.options.toolbar"
          :placeholder="field.name"
      />
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";
import Editor from "@tinymce/tinymce-vue";

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ["resourceName", "resourceId", "field", "options"],

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
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || "";
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
