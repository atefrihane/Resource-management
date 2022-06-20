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
            Add a new resource
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
          <div class="mb-4">
            <label
              class="block text-gray-700 text-sm font-bold mb-2"
              for="username"
            >
              Type
            </label>
            <select
              class="
                block
                appearance-none
                w-full
                border border-gray-200
                text-gray-700
                py-3
                px-4
                pr-8
                rounded
                leading-tight
                focus:outline-none focus:bg-white focus:border-gray-500
              "
              v-model="type"
            >
              <option value="">Select resource type</option>
              <option value="html">HTML</option>
              <option value="pdf">PDF</option>
              <option value="link">Link</option>
            </select>
          </div>
          <AddHtml
            v-if="type == 'html'"
            v-on:resourceCreated="$emit('resourceCreated')"
          />

          <AddLink
            v-if="type == 'link'"
            v-on:resourceCreated="$emit('resourceCreated')"
          />

          <AddPdf
            v-if="type == 'pdf'"
            v-on:resourceCreated="$emit('resourceCreated')"
          />
        </div>
      </div>
    </div>
  </Modal>
</template>

<script>
import Modal from "../Extra/Modal.vue";
import AddHtml from "../Resource/Html/AddHtml.vue";
import AddPdf from "../Resource/Pdf/AddPdf.vue";
import AddLink from "../Resource/Link/AddLink.vue";
export default {
    emits: ["resourceCreated","closeModal"],
  data() {
    return {
      show: true,
      type: "",
    };
  },
  components: {
    Modal,
    AddHtml,
    AddPdf,
    AddLink,
  },
};
</script>


