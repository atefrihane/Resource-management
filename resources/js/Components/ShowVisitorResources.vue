<template>
  <div class="container md:mx-auto md:px-20 md:py-20">
    <h1 class="text-3xl font-bold underline text-center mb-3">
      Resource Management
    </h1>

  


    <div class="py-20">
      <div class="p-2 md:p-0 md:flex md:flex-wrap md:justify-center">
        <template v-for="(resource, key) in resources.data" :key="key">
          <ResourceTile :resource="resource" />
        </template>
      </div>

      <div class="flex justify-center">
        <pagination
          :data="resources"
          :limit="1"
          @pagination-change-page="fetchResources"
        ></pagination>
      </div>
    </div>
  </div>
</template>

<script>
import LaravelVuePagination from "laravel-vue-pagination";

import ResourceTile from "./Resource/ResourceTile.vue";

export default {
  mounted() {
    this.fetchResources();
  },
  components: {
    ResourceTile,
    Pagination: LaravelVuePagination,
  },
  data() {
    return {
      showAddResource: false,

      resources: {},
      resourceToDelete: null,
      resourceToUpdate: null,
    };
  },
  methods: {
    fetchResources(page = 1) {
      axios
        .get(`/api/resources?page=${page}`)
        .then((response) => {
          // handle success
          this.resources = response.data.resources;
          console.log(response);
        })
        .catch((error) => {
          // handle error
          console.log(error);
        });
    },
    resourceCreated() {
      this.showAddResource = false;
      this.fetchResources();
    },

    resourceUpdated() {
      this.resourceToUpdate = null;
      this.fetchResources();
    },

    resourceDeleted() {
      this.resourceToDelete = null;
      this.fetchResources();
    },

    getResourceType(resource) {
      if (resource.resource_type == "App\\Models\\Html") {
        return "HTML";
      }

      if (resource.resource_type == "App\\Models\\Pdf") {
        return "PDF";
      }

      if (resource.resource_type == "App\\Models\\Link") {
        return "Link";
      }
    },
  },
};
</script>


