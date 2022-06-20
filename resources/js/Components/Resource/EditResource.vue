<template>
  <Modal>
    <div
      class="relative p-4 w-full max-w-2xl h-full md:h-auto"
      bis_skin_checked="1"
    >
      <div
        class="relative bg-white rounded-lg shadow dark:bg-gray-700"
        bis_skin_checked="1"
      >
        <div
          class="
            flex
            justify-between
            items-start
            p-4
            rounded-t
            border-b
            dark:border-gray-600
          "
          bis_skin_checked="1"
        >
          <h3
            class="
              text-xl
              font-semibold
              text-gray-900
              dark:text-white
              text-center
            "
          >
            Edit resource
          </h3>
          <button
            type="button"
            class="
              text-gray-400
              bg-transparent
              hover:bg-gray-200 hover:text-gray-900
              rounded-lg
              text-sm
              p-1.5
              ml-auto
              inline-flex
              items-center
              dark:hover:bg-gray-600 dark:hover:text-white
            "
            @click="$emit('closeModal')"
          >
            <svg
              class="w-5 h-5"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </button>
        </div>

        <div class="p-6 space-y-6" bis_skin_checked="1">
          <EditHtml
            v-if="isHtml"
            :resource="resource"
            v-on:resourceUpdated="$emit('resourceUpdated')"
            
          />

          <EditLink
            v-if="isLink"
            :resource="resource"
            v-on:resourceUpdated="$emit('resourceUpdated')"
          />

          <EditPdf
            v-if="isPdf"
            :resource="resource"
            v-on:resourceUpdated="$emit('resourceUpdated')"
          />
        </div>
      </div>
    </div>
  </Modal>
</template>

<script>
import Modal from "../Extra/Modal.vue";
import EditHtml from "../Resource/Html/EditHtml.vue";
import EditPdf from "../Resource/Pdf/EditPdf.vue";
import EditLink from "../Resource/Link/EditLink.vue";
export default {
     emits: ["resourceUpdated"],
  props: ["resource"],
  data() {
    return {
      show: true,
      type: "",
    };
  },
  components: {
    Modal,
    EditHtml,
    EditPdf,
    EditLink,
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
};
</script>


