<template>

    <div
      id="defaultModal"
      tabindex="-1"
      class="
        overflow-y-auto overflow-x-hidden
        fixed
        top-0
        right-0
        left-0
        z-50
        w-full
        md:inset-0
        h-modal
        md:h-full
        justify-center
        items-center
        flex
      "
 
      bis_skin_checked="1"
      aria-modal="true"
      role="dialog"
    >
      <slot> </slot>
    </div>


  <div
    modal-backdrop=""
    class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"
    bis_skin_checked="1"
  ></div>
</template>

<script>
export default {
  data() {
    return {

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