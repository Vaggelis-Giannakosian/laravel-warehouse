<template>
    <div class="text-right float-none">
        <div class="flex justify-between items-end mt-3 mb-2">

            <h3 v-if="label" v-text="label" class="mr-auto text-lg text-lg mb-0"></h3>

            <Input type="text" v-model="searchText" :placeholder="'Search'"
                   class="ml-auto py-1"/>
        </div>

        <a-table class="overflow-auto"
                 :columns="columns"
                 :data-source="filteredData"
                 @change="handleChange"
                 v-dragscroll
                 rowKey="id"
                 :loading="loading"
        >

            <template v-for="(index, name, data) in $slots" #[name]="data">
                <slot :name="name" v-bind="data"></slot>
            </template>

        </a-table>
    </div>
</template>

<script>
import {defineComponent} from 'vue';
import {ExpandOutlined, ExpandAltOutlined, EditOutlined} from '@ant-design/icons-vue'
import Input from '@/Components/FormInputs/Input';
import {map, get} from "lodash";

export default defineComponent({
    name: "SearchTable",
    components: {
        Input,
        ExpandOutlined,
        ExpandAltOutlined,
        EditOutlined,
    },
    props: {
        label: String,
        tableData: {
            type: Array,
            default: []
        },
        columns: {
            type: Array,
            default: []
        },
        filters: {
            type: Array,
            default: []
        },
        loading:Boolean
    },
    data() {
        return {
            filteredInfo: null,
            sortedInfo: null,
            filtered: false,
            searchText: ""
        }
    },
    methods: {
        handleChange(pagination, filters, sorter) {
            this.filteredInfo = filters
            this.sortedInfo = sorter
        },
    },
    computed: {
        filteredData() {

            this.filtered = !!this.searchText
            if (!this.searchText) return this.tableData

            const reg = new RegExp(this.searchText, "gi");
            return map(this.tableData, record => {

                const matches = this.filters.map(function (key) {
                    return String(get(record, key)).match(reg);
                })
                return matches.filter(Boolean).length === 0 ? null : record
            }).filter(record => !!record);

        },
        processedColumns() {
            let sortedInfo = this.sortedInfo;
            let filteredInfo = this.filteredInfo
            sortedInfo = sortedInfo || {};
            filteredInfo = filteredInfo || {};

            return this.columns
        }
    }
})
</script>

<style lang="scss">

.ant-table-wrapper {

    .ant-pagination.ant-table-pagination {

        .ant-pagination-item-link {
            display: flex;
            align-items: center;
            justify-content: center;
        }

    }

    .ant-table-thead th{
        @apply bg-blue-600;
        color: white;

        &:hover{
            @apply bg-blue-500 #{!important};
        }

        &.ant-table-column-sort{
            @apply bg-blue-500;

            .ant-table-column-sorter-inner .ant-table-column-sorter-up.on{
                color:white;
            }
        }
    }
    .ant-table-tbody td{
        border-color:#ccc;

        p{
            margin-bottom: 0;
        }
    }

}

</style>
