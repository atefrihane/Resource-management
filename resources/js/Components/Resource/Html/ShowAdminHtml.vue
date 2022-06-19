<template>
  <div
    class="
      bg-white
      rounded
      border border-green-500
      shadow
      mr-3
      h-100
      w-1/4
      overflow-hidden
    "
    style="height: 250px"
  >
    <div class="flex flex-col h-full">
      <div class="p-4">
        <div class="flex justify-between items-center mb-4">
          <h1 class="text-center text-2xl">{{ resource.title }}</h1>
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

        <p>{{ resource.type.description }}</p>
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
          >
            Copy
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["resource"],
};
</script>

<style>
</style>