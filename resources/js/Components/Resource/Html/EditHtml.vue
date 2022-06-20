<template>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2"> Title </label>
    <input
      class="
        shadow
        appearance-none
        border
        rounded
        w-full
        py-2
        px-3
        text-gray-700
        leading-tight
        focus:outline-none focus:shadow-outline
      "
      id="username"
      type="text"
      placeholder="Title"
      v-model="title"
    />
  </div>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">
      Description
    </label>

    <textarea
      class="
        shadow
        appearance-none
        border
        rounded
        w-full
        py-2
        px-3
        text-gray-700
        leading-tight
        focus:outline-none focus:shadow-outline
      "
      rows="2"
      placeholder="Description"
      v-model="description"
    ></textarea>
  </div>

  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">
      HTML snippet
    </label>

    <textarea
      class="
        shadow
        appearance-none
        border
        rounded
        w-full
        py-2
        px-3
        text-gray-700
        leading-tight
        focus:outline-none focus:shadow-outline
      "
      rows="2"
      placeholder="Your HTML code here..."
      v-model="snippet"
    ></textarea>
  </div>

  <div class="flex justify-center">
    <button
      type="button"
      class="
        text-white
        bg-green-700
        hover:bg-green-800
        focus:ring-4 focus:outline-none focus:ring-green-300
        font-medium
        rounded-lg
        text-sm
        px-5
        py-2.5
        text-center
        dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800
      "
      @click="updateHtml()"
    >
      Confirm
    </button>
    <Error
      v-if="validationErrors.length > 0"
      :errors="validationErrors"
      v-on:closeModal="errors = {}"
    />

    <Success
      v-if="success"
      :successMessage="'HTML resource updated..'"
      v-on:success="$emit('resourceUpdated')"
    />
  </div>
</template>

<script>
import Error from "../../Extra/Error.vue";
import Success from "../../Extra/Success.vue";
export default {
  emits: ["resourceUpdated"],
  props: ["resource"],
  data() {
    return {
      title: this.resource.title,
      description: this.resource.type.description,
      snippet: this.resource.type.snippet,
      errors: {},
      success: false,
    };
  },
  components: { Error, Success },
  computed: {
    validationErrors() {
      let errors = Object.values(this.errors);
      errors = errors.flat();
      return errors;
    },
  },
  methods: {
    updateHtml() {
      axios
        .put(`/api/resource/html/${this.resource.id}/update`, {
          title: this.title,
          description: this.description,
          snippet: this.snippet,
        })
        .then((response) => {
          console.log(response);
          this.success = true;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

<style>
</style>