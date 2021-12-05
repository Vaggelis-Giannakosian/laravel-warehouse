<template>
    <form @submit.prevent="form[submitMethod](submitUrl)">


            <div class="w-full flex ">
                <div class="w-1/2 px-2 mt-5">
                    <Label value="Όνομα" class="mb-2"/>
                    <Input type="text" v-model="form.name" class="w-full"/>
                    <InputError class="mb-0 mr-2" :message="form.errors.name"/>
                </div>

                <div class="w-1/2 px-2 mt-5">
                    <Label value="Σειρά" class="mb-2"/>
                    <Input type="text" v-model="form.ordering" class="w-full"/>
                    <InputError class="mb-0 mr-2" :message="form.errors.ordering"/>
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
    name: 'CategoryForm',
    props: ['submitMethod', 'submitUrl', 'category'],
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
            name: props.category?.name,
            description: props.category?.description,
            ordering: props.category?.ordering,
        })

        return {form}
    }
}
</script>
