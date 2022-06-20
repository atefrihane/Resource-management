<template>
  
    <div class="flex flex-col h-full">
      <div class="p-4">
        <div class="flex justify-between items-center mb-4">
          <h1 class="text-center text-2xl">{{ title }}</h1>
          <span
            class="
              bg-blue-100
              text-blue-800 text-xs
              font-semibold
              mr-2
              px-2.5
              py-0.5
              rounded
              dark:bg-blue-200 dark:text-blue-800
            "
            >PDF</span
          >
        </div>

        <p>This is a PDF resource.</p>
      </div>

      <div class="mt-auto">
        <div class="bg-red-900 h-px w-100 mb-2"></div>
        <div class="flex justify-center pb-2">
          <a
            :href="`/api/resource/${resource.id}/download`"
            class="
              flex
              mx-auto
              text-white
              bg-blue-700
              hover:bg-blue-800
              focus:ring-4 focus:outline-none focus:ring-blue-300
              font-medium
              rounded-lg
              text-sm
              px-5
              py-3
              text-center
              dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
            "
            >Download</a
          >
        </div>
      </div>
    </div>
    <Error
      v-if="validationErrors.length > 0"
      :errors="validationErrors"
      v-on:closeModal="errors = {}"
    />

</template>

<script>
import Error from "../../Extra/Error.vue";
export default {
  props: ["resource"],
  components: { Error },
  computed: {
    validationErrors() {
      let errors = Object.values(this.errors);
      errors = errors.flat();
      return errors;
    },

     title() {
      return this.resource.title.length > 25
        ? this.resource.title.substr(0, 25) + "..."
        : this.resource.title;
    },
  },
  data() {
    return {
      errors: {},
    };
  },
};
</script>

<style>
</style>