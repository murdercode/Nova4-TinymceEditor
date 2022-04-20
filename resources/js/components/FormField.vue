<template>
  <DefaultField :field="field" :errors="errors" :show-help-text="showHelpText">
    <template #field>
      <!--<input :id="field.attribute" type="text" class="w-full form-control form-input form-input-bordered"
        :class="errorClasses" :placeholder="field.name" v-model="value" />-->
      {{ apiKey }}
      <editor v-model="value" :api-key="field.options.apiKey" :init="field.options.init"
        :plugins="field.options.plugins" :toolbar="field.options.toolbar" :placeholder="field.name" />
    </template>
    </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import Editor from '@tinymce/tinymce-vue'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field', 'options'],

  components: {
    'editor': Editor
  },

  methods: {

    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || ''
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '')
    },
  },
}
</script>
