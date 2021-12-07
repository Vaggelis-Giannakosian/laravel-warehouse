<template>

    <Head title="Προϊόντα"/>

    <BreezeAuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Προϊόντα
            </h2>
        </template>

        <card>
            <div class="text-right mb-3">
                <nav-link :href="route('products.create')">
                    <primary-button>
                        Δημιουργία
                    </primary-button>
                </nav-link>
            </div>

            <SearchTable label="Λίστα προϊόντων" :table-data="products" :columns="columns"
                         :filters="['id','name','ska','current_price','quantity','status','category.name','provider.name']">


                <template #status="{text}">
                    <span class="px-2 py-1 text-xs font-bold leading-none rounded"
                          v-text="text === 'active' ? 'Ενεργό' : 'Ανενεργό'"
                          :class="{'text-green-100 bg-green-700' : text === 'active' , 'text-gray-100 bg-gray-500': text === 'inactive'}"
                    ></span>
                </template>

                <template #action="{record}">

                    <nav-link :href="route('products.show',record.id)" class="mr-3">
                        <a href="#" title="Προβολή">
                            <EyeOutlined/>
                        </a>
                    </nav-link>

                    <nav-link :href="route('products.edit',record.id)" class="mr-3">
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
import {EditOutlined, DeleteTwoTone,CheckCircleOutlined,CloseCircleOutlined, EyeOutlined } from '@ant-design/icons-vue'
import SearchTable from '@/Components/SearchTable';
import {Head} from '@inertiajs/inertia-vue3';

export default defineComponent({
    name: 'ProductsIndex',
    props: ['products'],
    components: {
        BreezeAuthenticatedLayout,
        SearchTable,
        EditOutlined, DeleteTwoTone,CheckCircleOutlined,CloseCircleOutlined,EyeOutlined,
        Head,
    },
    data() {
        return {}
    },
    methods: {
        deleteEntry(record) {
            this.$inertia.delete(this.route('products.destroy', record));
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
                    title: 'SKA',
                    dataIndex: 'ska',
                    key: 'ska',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.ska.localeCompare(b.ska),
                },
                {
                    title: 'Τρέχουσα τιμή',
                    dataIndex: 'current_price',
                    key: 'current_price',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.current_price - b.current_price,
                },
                {
                    title: 'Ποσότητα',
                    dataIndex: 'quantity',
                    key: 'quantity',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.quantity - b.quantity,
                },
                {
                    title: 'Κατάσταση',
                    dataIndex: 'status',
                    key: 'status',
                    width:130,
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.status.localeCompare(b.status),
                    slots:{
                        customRender: 'status'
                    }
                },
                {
                    title: 'Κατηγορία',
                    dataIndex: 'category.name',
                    key: 'category.name',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.category.name.localeCompare(b.category.name),
                },
                {
                    title: 'Προμηθευτής',
                    dataIndex: 'provider.name',
                    key: 'provider.name',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.provider.name.localeCompare(b.provider.name),
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
