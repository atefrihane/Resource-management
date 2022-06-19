<template>
  <ShowAdminHtml v-if="isHtml" :resource="resource" />
</template>

<script>
import ShowAdminHtml from "./Html/ShowAdminHtml.vue";
export default {
  props: ["resource"],
  components: {
    ShowAdminHtml,
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