<template>

    <Head title="Προμηθευτές"/>

    <BreezeAuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Προμηθευτές
            </h2>
        </template>

        <card>
            <div class="text-right mb-3">
                <nav-link :href="route('providers.create')">
                    <primary-button>
                        Δημιουργία
                    </primary-button>
                </nav-link>
            </div>

            <SearchTable label="Λίστα προμηθευτών" :table-data="providers" :columns="columns"
                         :filters="['id','name','description','address','phone1','phone2','fax']">

                <template #action="{record}">

                    <nav-link :href="route('providers.edit',record.id)" class="mr-3">
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
    name: 'ProvidersIndex',
    props: ['providers'],
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
            this.$inertia.delete(this.route('providers.destroy', record));
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
                    title: 'Περιγραφή',
                    dataIndex: 'description',
                    key: 'description',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.description.localeCompare(b.description),
                },
                {
                    title: 'Διεύθυνση',
                    dataIndex: 'address',
                    key: 'address',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.address.localeCompare(b.address),
                },
                {
                    title: 'Τηλέφωνο 1',
                    dataIndex: 'phone1',
                    key: 'phone1',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.phone1 - b.phone1,
                },
                {
                    title: 'Τηλέφωνο 2',
                    dataIndex: 'phone2',
                    key: 'phone2',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.phone2 - b.phone2,
                },
                {
                    title: 'Φαξ',
                    dataIndex: 'fax',
                    key: 'fax',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.fax - b.fax,
                },
                {
                    title: 'Χώρα',
                    dataIndex: 'country.name',
                    key: 'country.name',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.country.name.localeCompare(b.country.name),
                },
                {
                    title: 'Προϊόντα',
                    dataIndex: 'products_count',
                    key: 'products',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.products_count - b.products_count,
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
