<template>
    <form @submit.prevent="priceForm.post(route('prices.store',product),{onSuccess: initForm})">

        <div class="flex items-start">
            <div class="px-2 mt-5">
                <Label value="Τιμή" class="mb-2"/>
                <Input type="text" v-model="priceForm.price" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="priceForm.errors.price"/>
            </div>

            <div class="px-2 mt-5">
                <Label value="Ημερομηνία" class="mb-2"/>
                <Datepicker type="text" v-model:date="priceForm.datetime" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="priceForm.errors.datetime"/>
            </div>
        </div>

        <Button class="ml-2 mt-2" :disabled="priceForm.processing">
            ΚΑΤΑΧΩΡΗΣΗ ΤΙΜΗΣ
        </Button>
    </form>

    <SearchTable v-if="product" label="Λίστα τιμών" :table-data="product.prices" :columns="columns" class="px-2"
                 :filters="['id','name','ska','current_price','quantity','status','category.name','provider.name']">


        <template #price="{text,record}">
            <div v-if="editablePriceForm?.id === record.id">
                <a-input v-model:value="editablePriceForm['price']"
                         style="margin: -5px 0"
                />
                <InputError class="mb-0 mr-2" :message="editablePriceForm.errors.price"/>
            </div>

            <template v-else>
                {{ text }}
            </template>
        </template>

        <template #date="{text,record}">
            <div  v-if="editablePriceForm?.id === record.id">
                <Datepicker  v-model:date="editablePriceForm['datetime']"
                    style="margin: -5px 0"
                />
                <InputError class="mb-0 mr-2" :message="editablePriceForm.errors.datetime"/>
            </div>

            <template v-else>
                {{ formatDate(text) }}
            </template>
        </template>


        <template #action="{record}">


            <div class="flex ">
                <div v-if="editablePriceForm?.id === record.id" class="mr-6">
                    <a @click="save(record.id)" class="mr-2">
                        <SaveOutlined/>
                    </a>
                    <a @click="cancel(record.id)">
                        <StopOutlined/>
                    </a>
                </div>

                <a href="#" v-else @click="edit(record.id)" class="mr-6" title="Επεξεργασία">
                    <EditOutlined/>
                </a>

                <a-popconfirm placement="topRight" title="Είστε σίγουροι πως θέλετε να προχωρήσετε με την διαγραφή"
                              ok-text="Ναι"
                              cancel-text="Όχι" @confirm="deleteEntry(record)">
                    <a href="#" title="Διαγραφή">
                        <DeleteTwoTone/>
                    </a>
                </a-popconfirm>
            </div>
        </template>

    </SearchTable>
</template>

<script>
import SearchTable from "@/Components/SearchTable";
import Input from "@/Components/FormInputs/Input";
import InputError from "@/Components/FormInputs/InputError";
import Button from "@/Components/FormInputs/Button";
import Label from "@/Components/FormInputs/Label";
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";
import {defineComponent} from 'vue'
import {EditOutlined, DeleteTwoTone, SaveOutlined, StopOutlined} from '@ant-design/icons-vue'
import moment from "moment";
import Datepicker from "@/Components/FormInputs/Datepicker";

export default defineComponent({
    name: "Prices",
    props: ['product', 'updateProduct'],
    components: {
        Datepicker,
        SearchTable,
        InputError,
        Input,
        Button, Label,
        EditOutlined, DeleteTwoTone, SaveOutlined, StopOutlined
    },
    setup(props) {
        const priceForm = useForm({
            price: '',
            datetime: moment(),
        })

        function initForm() {
            priceForm.reset()
            props.updateProduct()
        }

        const columns = [
            {
                title: 'ID',
                dataIndex: 'id',
                key: 'id',
                sortDirections: ['descend', 'ascend'],
                sorter: (a, b) => a.id - b.id,
            },
            {
                title: 'Τιμή',
                dataIndex: 'price',
                key: 'price',
                sortDirections: ['descend', 'ascend'],
                sorter: (a, b) => a.price - b.price,
                slots: {
                    customRender: 'price'
                }
            },
            {
                title: 'Ημερομηνία',
                dataIndex: 'datetime',
                key: 'datetime',
                sortDirections: ['descend', 'ascend'],
                sorter: (a, b) => new Date(a.datetime).getTime() - new Date(b.datetime).getTime(),
                slots: {
                    customRender: 'date'
                }
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

        function deleteEntry(record) {
            Inertia.delete(route('prices.destroy', [props.product, record]), {
                onSuccess: () => {
                    props.updateProduct()
                }
            });
        }

        function formatDate(dateString) {
            return moment(dateString).format('DD/MM/YY HH:mm')
        }


        const editablePriceForm = useForm({
            id: '',
            price: '',
            datetime: ''
        });

        const edit = (id) => {
            const price = props.product.prices.filter(item => id === item.id)[0];
            editablePriceForm.id = price.id;
            editablePriceForm.price = price.price;
            editablePriceForm.datetime = moment(price.datetime)
        };
        const save = (id) => {
            editablePriceForm.put(route('prices.update', [props.product, id]),{
                onSuccess: ()=>{editablePriceForm.reset();cancel(id);props.updateProduct()}
            });
        };
        const cancel = (id) => {
            editablePriceForm.reset()
            editablePriceForm.clearErrors()
        };


        return {priceForm, columns, deleteEntry, formatDate, initForm, editablePriceForm, edit, save, cancel}
    }
})
</script>

<style scoped>

</style>
