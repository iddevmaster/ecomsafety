<template>
    <div>
      <b-form-group
        label="Selection mode:"
        label-for="table-select-mode-select"
        label-cols-md="4"
      >
        <!-- <b-form-select
          id="table-select-mode-select"
          v-model="selectMode"
          :options="modes"
          class="mb-3"
        ></b-form-select> -->


        <b-form-select v-model="selected"  v-on:change="changeshell($event)">
               <option :value="0">  ทั้งหมด</option>
                        <option
                            v-for="(option, idx) in cate"
                            :key="idx"
                            :value="option.id"
                            :title="option.title || null">
                            {{ option.title }}
                        </option>
                    </b-form-select>
      </b-form-group>
  
      <b-table
        :items="items"
        :fields="fields"
        :select-mode="selectMode"
        responsive="sm"
        ref="selectableTable"
        selectable
        @row-selected="onRowSelected"
      >
        <!-- Example scoped slot for select state illustrative purposes -->
        <template #cell(selected)="{ rowSelected }">
          <template v-if="rowSelected">
            <span aria-hidden="true">&check;</span>
            <span class="sr-only">Selected</span>
          </template>
          <template v-else>
            <span aria-hidden="true">&nbsp;</span>
            <span class="sr-only">Not selected</span>
          </template>
        </template>
      </b-table>
      <p>
        <b-button size="sm" @click="selectAllRows">Select all</b-button>
        <b-button size="sm" @click="clearSelected">Clear selected</b-button>
        <b-button size="sm" @click="selectThirdRow">Select 3rd row</b-button>
        <b-button size="sm" @click="unselectThirdRow">Unselect 3rd row</b-button>
      </p>
      <p>
        Selected Rows:<br>
        {{ selected }}
      </p>
    </div>
  </template>
  
  <script>
     import { FETCH_PRODUCT,FETCH_PRODUCT_CATE } from "../../store/actions.type";
     import { mapGetters,mapState } from "vuex";
    export default {
      data() {
        return {
          modes: ['multi', 'single', 'range'],
          fields: ['selected', 'isActive', 'age', 'first_name', 'last_name'],
          items: [],
          selectMode: 'multi',
          selected: 0
        }
      },

      computed: {
        ...mapState({
                objectscate: state => state.Product.cate,
            }),

            ...mapGetters(["cate"])

        },

        async mounted() {
            let product = await this.$store.dispatch(FETCH_PRODUCT);
            let cate = await this.$store.dispatch(FETCH_PRODUCT_CATE);
     
        },

      methods: {

        async changeshell(event){
                console.log(event);
            },
        onRowSelected(items) {
          this.selected = items
        },
        selectAllRows() {
          this.$refs.selectableTable.selectAllRows()
        },
        clearSelected() {
          this.$refs.selectableTable.clearSelected()
        },
        selectThirdRow() {
          // Rows are indexed from 0, so the third row is index 2
          this.$refs.selectableTable.selectRow(2)
        },
        unselectThirdRow() {
          // Rows are indexed from 0, so the third row is index 2
          this.$refs.selectableTable.unselectRow(2)
        }
      }
    }
  </script>