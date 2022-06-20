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
    <label
      class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
      for="file_input"
      >Upload file</label
    >
    <input
      class="
        block
        w-full
        text-sm text-gray-900
        bg-gray-50
        rounded-lg
        border border-gray-300
        cursor-pointer
        dark:text-gray-400
        focus:outline-none
        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
      "
      @change="selectFile($event)"
      type="file"
    />
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
      @click="savePdf()"
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
      :successMessage="'Pdf resource created..'"
      v-on:success="$emit('resourceCreated')"
    />
  </div>
</template>

<script>
import Error from "../../Extra/Error.vue";
import Success from "../../Extra/Success.vue";
export default {
  emits: ["resourceCreated"],
  data() {
    return {
      title: "",
      file: "",

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
    selectFile(event) {
      this.file = event.target.files[0];
    },
    savePdf() {
      let body = new FormData();
      body.append("title", this.title);
      body.append("file", this.file);
      axios
        .post("/api/resource/pdf/save", body)
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