<template>
    <form @submit.prevent="form[submitMethod](submitUrl)">

        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label value="Όνομα" class="mb-2"/>
                <Input type="text" v-model="form.name" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.name"/>
            </div>

            <div class="w-1/2 px-2 mt-5">
                <Label value="Διεύθυνση" class="mb-2"/>
                <Input type="text" v-model="form.address" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.address"/>
            </div>
        </div>

        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label value="Τηλέφωνο1" class="mb-2"/>
                <Input type="text" v-model="form.phone1" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.phone1"/>
            </div>

            <div class="w-1/2 px-2 mt-5">
                <Label value="Τηλέφωνο2" class="mb-2"/>
                <Input type="text" v-model="form.phone2" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.phone2"/>
            </div>
        </div>

        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label value="Φαξ" class="mb-2"/>
                <Input type="text" v-model="form.fax" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.fax"/>
            </div>

            <div class="w-1/2 px-2 mt-5">
                <Label value="Χώρα" class="mb-2"/>
                <SelectInput :options="countries" :searchable="true" v-model="form.country_id" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.country_id"/>
            </div>
        </div>


        <div class="px-2 mt-5">
            <Label value="Περιγραφή" class="mb-2"/>
            <TextArea type="text" v-model="form.description" class="w-full"/>
            <InputError class="mb-0 mr-2" :message="form.errors.description"/>
        </div>

        <div class="text-right py-3 px-2">
            <Button type="submit" :disabled="form.processing">
                ΥΠΟΒΟΛΗ
            </Button>
        </div>
    </form>
</template>

<script>
import {useForm} from '@inertiajs/inertia-vue3'
import Input from '@/Components/FormInputs/Input'
import SelectInput from '@/Components/FormInputs/SelectInput'
import InputError from '@/Components/FormInputs/InputError'
import Label from '@/Components/FormInputs/Label'
import Button from '@/Components/FormInputs/Button'
import TextArea from "@/Components/FormInputs/TextArea";

export default {
    name: 'ProviderForm',
    props: ['submitMethod', 'submitUrl', 'provider','countries'],
    components: {
        TextArea,
        Input,
        SelectInput,
        InputError,
        Label,
        Button
    },
    setup(props) {
        const form = useForm({
            name: props.provider?.name,
            address: props.provider?.address,
            description: props.provider?.description,
            phone1: props.provider?.phone1,
            phone2: props.provider?.phone2,
            fax: props.provider?.fax,
            country_id: props.provider?.country_id,
        })

        return {form}
    }
}
</script>
