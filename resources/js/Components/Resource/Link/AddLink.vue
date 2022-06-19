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
      Link (URL)
    </label>
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
      placeholder="Link(URL).."
      v-model="url"
    />
  </div>

  <div class="mb-4">
    <div class="flex items-center mb-4">
      <input
        id="default-checkbox"
        type="checkbox"
        @click="open_tab = !open_tab"
        class="
          w-4
          h-4
          text-blue-600
          bg-gray-100
          rounded
          border-gray-300
          focus:ring-blue-500
          dark:focus:ring-blue-600 dark:ring-offset-gray-800
          focus:ring-2
          dark:bg-gray-700 dark:border-gray-600
        "
      />
      <label
        for="default-checkbox"
        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Open in new tab</label
      >
    </div>
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
      @click="saveUrl()"
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
      :successMessage="'Link resource created..'"
      v-on:success="$emit('resourceCreated')"
    />
  </div>
</template>

<script>
import Error from "../../Extra/Error.vue";
import Success from "../../Extra/Success.vue";
export default {
  data() {
    return {
      title: "",
      url: "",
      open_tab: false,
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
    saveUrl() {
      axios
        .post("/api/resource/link/save", {
          title: this.title,
          url: this.url,
          open_tab: this.open_tab,
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