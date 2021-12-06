<template>

    <Head title="Χρήστες"/>

    <BreezeAuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Χρήστες
            </h2>
        </template>

        <card>
            <div class="text-right mb-3">
                <nav-link :href="route('users.create')">
                    <primary-button>
                        Δημιουργία
                    </primary-button>
                </nav-link>
            </div>

            <SearchTable label="Λίστα προμηθευτών" :table-data="users" :columns="columns"
                         :filters="['id','username','email','name','last_name','address','status','country.name']">



                <template #status="{text}">
                    <span class="px-2 py-1 text-xs font-bold leading-none rounded"
                          v-text="text.toUpperCase()"
                          :class="{'text-green-100 bg-green-700' : text === 'active' , 'text-gray-100 bg-gray-500': text === 'inactive'}"
                    ></span>
                </template>

                <template #is_admin="{text}">
                    <div class="text-center">
                        <CheckCircleOutlined class="text-green-700" v-if="parseInt(text)" />
                        <CloseCircleOutlined class="text-red-700" v-else />
                    </div>
                </template>

                <template #action="{record}">

                    <nav-link :href="route('users.edit',record.id)" class="mr-3">
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
import {EditOutlined, DeleteTwoTone,CheckCircleOutlined,CloseCircleOutlined } from '@ant-design/icons-vue'
import SearchTable from '@/Components/SearchTable';
import {Head} from '@inertiajs/inertia-vue3';

export default defineComponent({
    name: 'ProvidersIndex',
    props: ['users'],
    components: {
        BreezeAuthenticatedLayout,
        SearchTable,
        EditOutlined, DeleteTwoTone,CheckCircleOutlined,CloseCircleOutlined,
        Head,
    },
    data() {
        return {}
    },
    methods: {
        deleteEntry(record) {
            this.$inertia.delete(this.route('users.destroy', record));
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
                    title: 'Επίθετο',
                    dataIndex: 'last_name',
                    key: 'last_name',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.last_name.localeCompare(b.last_name),
                },
                {
                    title: 'Διεύθυνση',
                    dataIndex: 'address',
                    key: 'address',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.address.localeCompare(b.address),
                },
                {
                    title: 'Όνομα χρήστη',
                    dataIndex: 'username',
                    key: 'username',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.username.localeCompare(b.username),
                },
                {
                    title: 'Email',
                    dataIndex: 'email',
                    key: 'email',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.email.localeCompare(b.email),
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
                    title: 'Διαχειριστής',
                    dataIndex: 'is_admin',
                    key: 'is_admin',
                    width:140,
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.is_admin - b.is_admin,
                    slots:{
                        customRender: 'is_admin'
                    }
                },
                {
                    title: 'Χώρα',
                    dataIndex: 'country.name',
                    key: 'country.name',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.country.name.localeCompare(b.country.name),
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
