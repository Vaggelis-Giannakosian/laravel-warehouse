<template>
    <form @submit.prevent="priceForm.post(route('prices.store',product))">

        <div class="flex items-start">
            <div class="px-2 mt-5">
                <Label value="Τιμή" class="mb-2"/>
                <Input type="text" v-model="priceForm.price"  class="w-full"/>
                <InputError class="mb-0 mr-2" :message="priceForm.errors.price"/>
            </div>

            <div class="px-2 mt-5">
                <Label value="Ημερομηνία" class="mb-2"/>
                <Input type="text" v-model="priceForm.datetime" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="priceForm.errors.datetime"/>
            </div>
        </div>

        <Button class="ml-2 mt-2">
            ΚΑΤΑΧΩΡΗΣΗ
        </Button>
    </form>

    <SearchTable v-if="product" label="Λίστα τιμών" :table-data="product.prices" :columns="columns"
                 :filters="['id','name','ska','current_price','quantity','status','category.name','provider.name']">

        <template #date="{text}">
            {{ formatDate(text) }}
        </template>


        <template #action="{record}">
            <nav-link href="" class="mr-3">
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
import {EditOutlined,DeleteTwoTone} from '@ant-design/icons-vue'
import moment from "moment";

export default defineComponent({
    name: "Prices",
    props:['product','updateProduct'],
    components:{
        SearchTable,
        InputError,
        Input,
        Button,Label,
        EditOutlined,DeleteTwoTone
    },
    setup(props){
        const priceForm = useForm({
            price: '',
            datetime: '',
        })

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

        function deleteEntry(record){
            Inertia.delete(route('prices.destroy',[props.product,record]),{
                onSuccess:()=>{
                    props.updateProduct()
                }
            });
        }

        function formatDate(dateString) {
            return moment(dateString).format('DD/MM/YY HH:mm')
        }

        return {priceForm,columns,deleteEntry,formatDate}
    }
})
</script>

<style scoped>

</style>
