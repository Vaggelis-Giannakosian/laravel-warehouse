<template>
    <form @submit.prevent="form[submitMethod](submitUrl)">

        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label value="Όνομα" class="mb-2"/>
                <Input type="text" v-model="form.name" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.name"/>
            </div>

            <div class="w-1/2 px-2 mt-5">
                <Label value="Κωδικός" class="mb-2"/>
                <Input type="text" v-model="form.code" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.code"/>
            </div>
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

export default {
    name: 'CountryForm',
    props: ['submitMethod', 'submitUrl', 'country'],
    components: {
        Input,
        SelectInput,
        InputError,
        Label,
        Button
    },
    setup(props) {
        const form = useForm({
            name: props.country?.name,
            code: props.country?.code,
        })

        return {form}
    }
}
</script>
