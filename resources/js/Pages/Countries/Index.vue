<template>

    <Head title="Dealers"/>

    <BreezeAuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Χώρες
            </h2>
        </template>

        <card>
            <div class="text-right mb-3">
                <nav-link :href="route('countries.create')">
                    <primary-button>
                        Δημιουργία
                    </primary-button>
                </nav-link>
            </div>

            <SearchTable label="Λίστα χωρών" :table-data="countries" :columns="columns"
                         :filters="['id','name','code','users_count','providers_count']">

                <template #action="{record}">

                    <nav-link :href="route('countries.edit',record.id)" class="mr-3">
                        <a href="#" title="Επεξεργασία">
                            <EditOutlined/>
                        </a>
                    </nav-link>

                    <a-popconfirm placement="topRight" title="Είστε σίγουροι πως θέλετε να προχωρήσετε με την διαγραφή" ok-text="Ναι"
                                  cancel-text="Όχι" @confirm="deleteEntry(record)">
                        <a href="#" title="Διαγραφή">
                            <DeleteTwoTone/>
                        </a>
                    </a-popconfirm>


                </template>

            </SearchTable>
        </card>

    </BreezeAuthenticatedLayout>


</template>


<script>
import {defineComponent} from 'vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {EditOutlined, DeleteTwoTone} from '@ant-design/icons-vue'
import SearchTable from '@/Components/SearchTable';
import {Head} from '@inertiajs/inertia-vue3';

export default defineComponent({
    name: 'CountriesIndex',
    props: ['countries'],
    components: {
        BreezeAuthenticatedLayout,
        SearchTable,
        EditOutlined, DeleteTwoTone,
        Head,
    },
    data() {
        return {}
    },
    methods: {
        deleteEntry(record) {
            this.$inertia.delete(this.route('countries.destroy', record));
        }
    },
    computed: {
        columns() {
            return [
                {
                    title: 'ID',
                    dataIndex: 'id',
                    key: 'id',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.id - b.id,
                },
                {
                    title: 'Όνομα',
                    dataIndex: 'name',
                    key: 'name',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.name.localeCompare(b.name),
                },
                {
                    title: 'Κωδικός',
                    dataIndex: 'code',
                    key: 'code',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.code.localeCompare(b.code),
                },
                {
                    title: 'Χρήστες',
                    dataIndex: 'users_count',
                    key: 'users',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.users_count - b.users_count,
                },
                {
                    title: 'Προμηθευτές',
                    dataIndex: 'providers_count',
                    key: 'providers',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.providers_count - b.providers_count,
                },
                {
                    title: 'Ενέργειες',
                    dataIndex: '',
                    key: 'x',
                    slots: {
                        customRender: 'action',
                    },
                },
            ];
        }
    }
});
</script>
