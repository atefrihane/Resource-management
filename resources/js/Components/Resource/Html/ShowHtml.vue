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
            >HTML</span
          >
        </div>

        <p class="mb-2">{{ description }}</p>
      </div>

      <div class="mt-auto">
        <div class="bg-red-900 h-px w-100 mb-2"></div>
        <div class="flex justify-center pb-2">
          <button
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
            type="button"
            @click="showSnippet = true"
          >
            View
          </button>
        </div>
      </div>
    </div>
    <ShowSnippet
      v-if="showSnippet"
      v-on:closeModal="showSnippet = false"
      :snippet="resource.type.snippet"
    />
 
</template>

<script>
import ShowSnippet from "./ShowSnippet.vue";
export default {
  props: ["resource"],

  components: {
    ShowSnippet,
  },
  computed: {
    title() {
      return this.resource.title.length > 10
        ? this.resource.title.substr(0, 10) + "..."
        : this.resource.title;
    },
    description() {
      return this.resource.type.description.length > 80
        ? this.resource.type.description.substr(0, 80) + "..."
        : this.resource.type.description;
    },
  },
  data() {
    return {
      showSnippet: false,
    };
  },
};
</script>

<style>
</style>