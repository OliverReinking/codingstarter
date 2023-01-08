<template>
  <!-- Anzeige der Liste -->
  <div class="np-dl-outer-container">
    <div class="np-dl-title">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <div>
          {{ title }}
        </div>
        <div>
          <button-group>
            <input-button v-if="createOn" type="button">
              <Link :href="route(routeCreate)" class="flex items-center">
                <icon-add-circle class="h-4 w-4 mr-1" />Neu
              </Link></input-button
            >
            <slot name="button"></slot>
          </button-group>
        </div>
      </div>
    </div>

    <div class="mb-4" v-if="searchFilter">
      <div class="my-6 flex justify-between items-center">
        <search-filter
          v-model="form.search"
          class="w-full"
          :searchText="searchText"
          @reset="reset"
        >
        </search-filter>
      </div>
    </div>
    <div class="np-dl-data-container">
      <table class="np-dl-table">
        <thead class="np-dl-thead">
          <slot name="header"></slot>
        </thead>
        <tbody>
          <tr
            v-for="datarow in datarows.data"
            :key="datarow.id"
            class="np-dl-tr"
          >
            <slot name="datarow" :datarow="datarow"></slot>
            <td
              v-if="editOn"
              class="np-dl-td-edit"
              @click.prevent="editDataRow(datarow.id)"
            >
              <icon-edit class="w-6 h-6" v-tippy />
              <tippy>{{ editDescription }}</tippy>
            </td>
            <td
              v-if="showOn"
              class="np-dl-td-edit"
              @click.prevent="showDataRow(datarow.id)"
            >
              <icon-eye class="w-6 h-6" v-tippy />
              <tippy>{{ showDescription }}</tippy>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-if="datarows.data.length === 0">
        <div class="np-dl-td-no-entries">
          {{ noEntries }}
        </div>
      </div>
    </div>
    <pagination :links="datarows.links" />
  </div>
  <!-- ENDS Anzeige der Liste -->
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

import SearchFilter from "@/Pages/Components/Lists/SearchFilter.vue";
import Pagination from "@/Pages/Components/Lists/Pagination.vue";

import ButtonGroup from "@/Pages/Components/Form/ButtonGroup.vue";
import InputButton from "@/Pages/Components/Form/InputButton.vue";

import IconAddCircle from "@/Pages/Components/Icons/AddCircle.vue";
import IconEdit from "@/Pages/Components/Icons/Edit.vue";
import IconEye from "@/Pages/Components/Icons/Eye.vue";

import mapValues from "lodash/mapValues";
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";

export default {
  components: {
    Link,
    SearchFilter,
    Pagination,
    ButtonGroup,
    InputButton,
    IconAddCircle,
    IconEdit,
    IconEye,
  },
  //
  props: {
    title: {
      type: String,
      required: false,
    },
    datarows: {
      type: [Object, Array],
      default: () => [],
    },
    noEntries: {
      type: String,
      default: "Es wurden keine Datensätze gefunden.",
    },
    filters: {
      type: [Object, Array],
      default: () => [],
    },
    routeIndex: {
      type: String,
      default: null,
    },
    routeParam: {
      type: [Number, String],
      default: null,
    },
    searchFilter: {
      type: Boolean,
      default: true,
    },
    searchText: {
      type: String,
    },
    showOn: {
      type: Boolean,
      default: false,
    },
    routeShow: {
      type: String,
    },
    editOn: {
      type: Boolean,
      default: false,
    },
    routeEdit: {
      type: String,
    },
    createOn: {
      type: Boolean,
      default: false,
    },
    routeCreate: {
      type: String,
    },
    showDescription: {
      type: String,
      default: "Daten anzeigen",
    },
    editDescription: {
      type: String,
      default: "Daten ändern",
    },
  },
  //
  data() {
    return {
      form: {
        search: this.filters.search,
      },
    };
  },
  //
  watch: {
    form: {
      handler: throttle(function () {
        let query = pickBy(this.form);
        //
        let param = null;
        if (this.routeParam) {
          param = this.routeParam;
        }
        //
        if (this.searchFilter) {
          if (param) {
            this.$inertia.get(
              this.route(
                this.routeIndex,
                Object.keys(query).length
                  ? param
                  : { param, remember: "forget" }
              ),
              this.form,
              {
                preserveState: true,
              }
            );
          }
          if (!param) {
            this.$inertia.get(
              this.route(
                this.routeIndex,
                Object.keys(query).length ? query : { remember: "forget" }
              ),
              this.form,
              {
                preserveState: true,
              }
            );
          }
        }
      }, 150),
      deep: true,
    },
  },
  //
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null);
    },
    editDataRow(id) {
      this.$inertia.get(this.route(this.routeEdit, id));
    },
    //
    showDataRow(id) {
      this.$inertia.get(this.route(this.routeShow, id));
    },
  },
};
</script>
