<template>

    <Head title="Κατηγορίες"/>

    <BreezeAuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Κατηγορίες Προϊόντων
            </h2>
        </template>

        <card>
            <div class="text-right mb-3">
                <nav-link :href="route('categories.create')">
                    <primary-button>
                        Δημιουργία
                    </primary-button>
                </nav-link>
            </div>

            <SearchTable label="Λίστα κατηγοριών" :table-data="categories" :columns="columns"
                         :filters="['id','name','description','products_count','ordering']">

                <template #ordering="{text,record}">
                    <div class="editable-cell">
                        <div v-if="categoryToEdit.id === record.id"  class="editable-cell-input-wrapper flex items-center">
                            <div>
                                <a-input ref="editInput" type="number" v-model:value="categoryToEdit.ordering" @pressEnter="save(record)"/>
                                <InputError :message="form.errors.ordering"></InputError>
                            </div>
                            <SaveOutlined class="editable-cell-icon-check text-blue-600 ml-3" @click="save(record)"/>
                        </div>
                        <div v-else class="editable-cell-text-wrapper flex items-center">
                            {{ text || ' ' }}
                            <EditOutlined class="editable-cell-icon text-blue-600 ml-3" @click="edit(record)"/>
                        </div>
                    </div>
                </template>

                <template #action="{record}">

                    <nav-link :href="route('categories.edit',record.id)" class="mr-3">
                        <a href="#" title="Επεξεργασία">
                            <EditOutlined/>
                        </a>
                    </nav-link>

                    <a-popconfirm placement="topRight" title="Είστε σίγουροι πως θέλετε να προχωρήσετε με την διαγραφή"
                                  ok-text="Ναι"
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
import InputError from '@/Components/FormInputs/InputError'
import {EditOutlined, DeleteTwoTone, SaveOutlined} from '@ant-design/icons-vue'
import SearchTable from '@/Components/SearchTable';
import {Head} from '@inertiajs/inertia-vue3';

export default defineComponent({
    name: 'CategoriesIndex',
    props: ['categories'],
    components: {
        BreezeAuthenticatedLayout,
        SearchTable,
        InputError,
        EditOutlined, DeleteTwoTone, SaveOutlined,
        Head,
    },
    data() {
        return {
            categoryToEdit: {}
        }
    },
    methods: {
        save(record) {
            if(this.form.processing) return false;

            this.form.post(route('categories.update-order', record.id), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.categoryToEdit = {};
                    },
                    onFailure: () => {
                        console.log('asdf')
                    }
                })
        },
        edit(record) {
            this.categoryToEdit = record
            this.$nextTick(()=>{
                this.$refs.editInput.focus()
            })
        },
        deleteEntry(record) {
            this.$inertia.delete(this.route('categories.destroy', record));
        }
    },
    computed: {
        form() {
            return this.$inertia.form({
                'ordering': this.categoryToEdit.ordering
            })
        },
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
                    title: 'Σειρά',
                    dataIndex: 'ordering',
                    key: 'ordering',
                    sortDirections: ['descend', 'ascend'],
                    sorter: (a, b) => a.ordering - b.ordering,
                    slots: {
                        customRender: 'ordering',
                    },
                },
                {
                    title: 'Προϊόντα',
                    dataIndex: 'products_count',
                    key: 'products_count',
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
