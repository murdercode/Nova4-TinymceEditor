<template>
  <DefaultField :field="field" :errors="errors" :show-help-text="showHelpText">
    <template #field>
      <editor
        :id="field.attribute"
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
    this.setDarkMode();
  },

  methods: {
    setDarkMode() {
      this.field.options.init.skin =
        window.matchMedia("(prefers-color-scheme: dark)").matches ||
        document.querySelector("html").classList.contains("dark")
          ? "oxide-dark"
          : "";
      this.field.options.init.content_css =
        window.matchMedia("(prefers-color-scheme: dark)").matches ||
        document.querySelector("html").classList.contains("dark")
          ? "dark"
          : "";
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
