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
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table
          class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
          <thead
            class="
              text-xs text-gray-700
              uppercase
              bg-gray-200
              dark:bg-gray-700 dark:text-gray-400
            "
          >
            <tr>
              <th scope="col" class="px-6 py-3 text-center">Title</th>
              <th scope="col" class="px-6 py-3 text-center">Type</th>
              <th scope="col" class="px-6 py-3 text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="
                bg-white
                border-b
                dark:bg-gray-800 dark:border-gray-700
                text-center
              "
              v-for="(resource, key) in resources.data"
              :key="key"
            >
              <th
                scope="row"
                class="
                  px-6
                  py-4
                  font-medium
                  text-gray-900
                  dark:text-white
                  whitespace-nowrap
                "
              >
                {{ resource.title }}
              </th>
              <td class="px-6 py-4">{{ getResourceType(resource) }}</td>

              <td class="px-6 py-4 flex justify-center">
                <a
                  href="#"
                  class="
                    font-medium
                    text-blue-600
                    dark:text-blue-500
                    hover:underline
                    mr-2
                  "
                  @click="resourceToUpdate = resource"
                  >Edit</a
                >
                <a
                  href="#"
                  class="
                    font-medium
                    text-blue-600
                    dark:text-blue-500
                    hover:underline
                  "
                  @click="resourceToDelete = resource.id"
                  >Delete</a
                >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="flex justify-center">
      <pagination
        :data="resources"
        :limit="1"
        @pagination-change-page="fetchResources"
      ></pagination>
    </div>

  

    <ShowAddResource
      v-if="showAddResource"
      v-on:closeModal="showAddResource = false"
      v-on:resourceCreated="resourceCreated()"
    />

    <ShowUpdateResource
      v-if="resourceToUpdate"
      :resource="resourceToUpdate"
      v-on:closeModal="resourceToUpdate = null"
      v-on:resourceUpdated="resourceUpdated()"
    />

    <ShowDeleteResource
      v-if="resourceToDelete"
      :id="resourceToDelete"
      v-on:closeModal="resourceToDelete = null"
      v-on:resourceDeleted="resourceDeleted()"
    />
  </div>
</template>

<script>
import LaravelVuePagination from "laravel-vue-pagination";
import ShowAddResource from "./Resource/AddResource.vue";
import ShowUpdateResource from "./Resource/EditResource.vue";
import ShowDeleteResource from "./Resource/DeleteResource.vue";
import ResourceTile from "./Resource/ResourceTile.vue";

export default {
  
  mounted() {
    this.fetchResources();
  },
  components: {
    ShowAddResource,
    ShowUpdateResource,
    ResourceTile,
    Pagination: LaravelVuePagination,
    ShowDeleteResource,
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



<style>
.pagination {
  display: -ms-flexbox;
  display: flex;
  padding-left: 0;
  list-style: none;
  border-radius: 0.25rem;
}

.page-link {
  position: relative;
  display: block;
  padding: 0.5rem 0.75rem;
  margin-left: -1px;
  line-height: 1.25;
  color: #007bff;
  background-color: #fff;
  border: 1px solid #dee2e6;
}

.page-link:hover {
  z-index: 2;
  color: #0056b3;
  text-decoration: none;
  background-color: #e9ecef;
  border-color: #dee2e6;
}

.page-link:focus {
  z-index: 3;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.page-item:first-child .page-link {
  margin-left: 0;
  border-top-left-radius: 0.25rem;
  border-bottom-left-radius: 0.25rem;
}

.page-item:last-child .page-link {
  border-top-right-radius: 0.25rem;
  border-bottom-right-radius: 0.25rem;
}

.page-item.active .page-link {
  z-index: 3;
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
}

.page-item.disabled .page-link {
  color: #6c757d;
  pointer-events: none;
  cursor: auto;
  background-color: #fff;
  border-color: #dee2e6;
}

.pagination-lg .page-link {
  padding: 0.75rem 1.5rem;
  font-size: 1.25rem;
  line-height: 1.5;
}

.pagination-lg .page-item:first-child .page-link {
  border-top-left-radius: 0.3rem;
  border-bottom-left-radius: 0.3rem;
}

.pagination-lg .page-item:last-child .page-link {
  border-top-right-radius: 0.3rem;
  border-bottom-right-radius: 0.3rem;
}

.pagination-sm .page-link {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
  line-height: 1.5;
}

.pagination-sm .page-item:first-child .page-link {
  border-top-left-radius: 0.2rem;
  border-bottom-left-radius: 0.2rem;
}

.pagination-sm .page-item:last-child .page-link {
  border-top-right-radius: 0.2rem;
  border-bottom-right-radius: 0.2rem;
}
</style>
