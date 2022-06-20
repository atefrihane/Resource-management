<template>
  <div
    class="
      bg-white
      rounded
      border border-green-500
      shadow
      mr-3
      h-100
      w-full
      md:w-1/4
      mb-5
      overflow-hidden
      card
    "
  >
    <ShowHtml v-if="isHtml" :resource="resource" />
    <ShowLink v-if="isLink" :resource="resource" />
    <ShowPdf v-if="isPdf" :resource="resource" />
  </div>
</template>

<script>
import ShowHtml from "./Html/ShowHtml.vue";
import ShowLink from "./Link/ShowLink.vue";
import ShowPdf from "./Pdf/ShowPdf.vue";
export default {
  props: ["resource"],
  components: {
    ShowHtml,
    ShowLink,
    ShowPdf,
  },
  computed: {
    isHtml() {
      return this.resource.resource_type == "App\\Models\\Html";
    },

    isPdf() {
      return this.resource.resource_type == "App\\Models\\Pdf";
    },

    isLink() {
      return this.resource.resource_type == "App\\Models\\Link";
    },
  },
  data() {
    return {};
  },
};
</script>

<style>
</style>