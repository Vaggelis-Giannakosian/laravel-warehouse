<template>
    <form @submit.prevent="form[submitMethod](submitUrl)">

        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label value="Όνομα" class="mb-2"/>
                <Input type="text" v-model="form.name" class="w-full" autofocus/>
                <InputError class="mb-0 mr-2" :message="form.errors.name"/>
            </div>

            <div class="w-1/2 px-2 mt-5">
                <Label value="SKA" class="mb-2"/>
                <Input type="text" v-model="form.ska" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.ska"/>
            </div>
        </div>

        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label value="Τρέχουσα τιμή" class="mb-2"/>
                <Input type="text" v-model="form.current_price" :disabled="product" class="w-full"
                       :class="{'bg-gray-200':product}"/>
                <InputError v-if="!product" class="mb-0 mr-2" :message="form.errors.current_price"/>
            </div>

            <div class="w-1/2 px-2 mt-5">
                <Label value="Ποσόστητα" class="mb-2"/>
                <Input type="text" v-model="form.quantity" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.quantity"/>
            </div>
        </div>

        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label for="provider" value="Προμηθευτής" class="mb-2"/>
                <SelectInput id="provider" :options="providers" :searchable="true" v-model="form.provider_id"
                             class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.provider_id"/>
            </div>

            <div class="w-1/2 px-2 mt-5">
                <Label for="category" value="Κατηγορία" class="mb-2"/>
                <SelectInput id="category" :options="categories"
                             :searchable="true"
                             v-model="form.category_id"
                             label="name"
                             value-prop="id"
                             track-by="name"
                             class="w-full"
                ></SelectInput>
                <InputError class="mb-0 mr-2" :message="form.errors.category_id"/>
            </div>
        </div>

        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label value="Κατάσταση" class="mb-2"/>
                <SelectInput :options="statuses" v-model="form.status" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.status"/>
            </div>
        </div>

        <div class="text-right py-3 px-2 mt-5">
            <Button type="submit" :disabled="form.processing">
                ΥΠΟΒΟΛΗ
            </Button>
        </div>
    </form>

    <Prices v-if="product" :product="product" :updateProduct="updateProduct"/>
</template>

<script>
import {useForm} from '@inertiajs/inertia-vue3'
import Input from '@/Components/FormInputs/Input'
import Checkbox from '@/Components/FormInputs/Checkbox'
import SelectInput from '@/Components/FormInputs/SelectInput'
import InputError from '@/Components/FormInputs/InputError'
import Label from '@/Components/FormInputs/Label'
import Button from '@/Components/FormInputs/Button'
import TextArea from "@/Components/FormInputs/TextArea";
import SearchTable from '@/Components/SearchTable'
import moment from "moment";
import {EditOutlined,DeleteTwoTone} from '@ant-design/icons-vue'
import Prices from './Prices'
export default {
    name: 'ProductForm',
    props: ['submitMethod', 'submitUrl', 'product', 'categories', 'providers'],
    components: {
        TextArea,
        Input,
        SelectInput,
        InputError,
        Label,
        Button,
        Checkbox,
        SearchTable,
        EditOutlined,DeleteTwoTone,
        Prices,
    },
    setup(props) {
        const form = useForm({
            name: props.product?.name,
            ska: props.product?.ska,
            current_price: props.product?.current_price,
            quantity: props.product?.quantity,
            status: props.product?.status,
            provider_id: props.product?.provider_id,
            category_id: props.product?.category_id,
        })

        const statuses = {active: 'Ενεργό', inactive: 'Ανενεργό'}

        function updateProduct(){
            form.current_price = props.product.current_price
        }

        return {form, statuses, updateProduct}
    }
}
</script>
