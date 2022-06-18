<template>
  <div class="container mx-auto px-20 py-20">
    <h1 class="text-3xl font-bold underline text-center mb-3">
      Resource Management
    </h1>

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
      @click="showAddResource = true"
    >
      Add Resource
    </button>

    <div class="py-20">
      <div class="flex flex-wrap">
        <div
          class="
            bg-white
            rounded
            border border-gray-200
            shadow
            mr-3
            p-4
            h-100
            w-1/4
            overflow-hidden
          "
        >
          <div class="flex-col">
            <h1 class="text-center text-3xl">lool</h1>
            <p>
              ahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahahah
            </p>
          </div>
        </div>

        <div
          class="
            bg-white
            rounded
            border border-gray-200
            shadow
            mr-3
            p-4
            h-100
            w-1/4
            overflow-hidden
          "
        >
          <div class="flex-col">
            <h1 class="text-center text-3xl">lool</h1>

            <div class="flex justify-center">
              <a
                href=""
                class="py-2 px-3 bg-gray-700 text-white mx-auto rounded"
                >Button</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <ShowAddResource
      v-if="showAddResource"
      v-on:closeModal="showAddResource = false"
    />

    <ShowEditResource v-if="showEditResource" :resource="selectedResource" />
  </div>
</template>

<script>
import ShowAddResource from "./Resource/AddResource.vue";
export default {
  mounted() {},
  components: {
    ShowAddResource,
  },
  data() {
    return {
      showAddResource: false,
      showEditResource: false,
      selectedResource: null,
    };
  },
};
</script>



<style scoped>
/* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
