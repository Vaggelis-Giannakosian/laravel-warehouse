<template>
    <form @submit.prevent="form[submitMethod](submitUrl)">

        <div>
            <div class="w-1/2 px-2 mt-5 flex items-center">
                <Label for="is_admin" value="Διαχειριστής" class="mr-3"/>
                <Checkbox id="is_admin" v-model:checked="form.is_admin" />
            </div>
            <InputError class="mb-0 mr-2" :message="form.errors.is_admin"/>
        </div>

        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label for="name" value="Όνομα" class="mb-2"/>
                <Input type="text" id="name" v-model="form.name" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.name"/>
            </div>

            <div class="w-1/2 px-2 mt-5">
                <Label for="last_name" value="Επίθετο" class="mb-2"/>
                <Input type="text" id="last_name" v-model="form.last_name" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.last_name"/>
            </div>
        </div>

        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label for="username" value="Όνομα χρήστη" class="mb-2"/>
                <Input type="text" id="username" v-model="form.username" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.username"/>
            </div>

            <div class="w-1/2 px-2 mt-5">
                <Label for="email" value="Email" class="mb-2"/>
                <Input type="text" id="email" v-model="form.email" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.email"/>
            </div>
        </div>


        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label for="address" value="Διεύθυνση" class="mb-2"/>
                <Input type="text" id="address" v-model="form.address" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.address"/>
            </div>

            <div class="w-1/2 px-2 mt-5">
                <Label value="Χώρα" for="country" class="mb-2"/>
                <SelectInput :options="countries" id="country" :searchable="true" v-model="form.country_id" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.country_id"/>
            </div>
        </div>

        <div class="flex ">
            <div class="w-1/2 px-2 mt-5">
                <Label value="Κωδικός" for="password" class="mb-2"/>
                <Input type="password" id="password" v-model="form.password" class="w-full" autocomplete="off"/>
                <InputError class="mb-0 mr-2" :message="form.errors.password"/>
                <span v-if="user" class="text-blue-600 text-xs">Αφήστε κενό εάν δεν επιθυμείτε να αλλαχτεί.</span>
            </div>

            <div class="w-1/2 px-2 mt-5">
                <Label for="password_confirmation" value="Επιβεβαίωση κωδικού" class="mb-2"/>
                <Input type="password" id="password_confirmation" v-model="form.password_confirmation" class="w-full"/>
                <InputError class="mb-0 mr-2" :message="form.errors.password_confirmation"/>
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

export default {
    name: 'UserForm',
    props: ['submitMethod', 'submitUrl', 'user', 'countries'],
    components: {
        TextArea,
        Input,
        SelectInput,
        InputError,
        Label,
        Button,
        Checkbox
    },
    setup(props) {
        const form = useForm({
            username: props.user?.username,
            email: props.user?.email,
            name: props.user?.name,
            last_name: props.user?.last_name,
            address: props.user?.address,
            country_id: props.user?.country_id,
            status: props.user?.status,
            is_admin: props.user?.is_admin === '1',
            password: props.user?.password,
            password_confirmation: props.user?.password_confirmation,
        })

        const statuses = {active: 'Ενεργός', inactive: 'Ανενεργός'}
        return {form, statuses}
    }
}
</script>
