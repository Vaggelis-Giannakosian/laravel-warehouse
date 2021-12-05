<template>
    <Head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="username" value="Όνομα χρήστη" />
            <BreezeInput id="username" type="text" class="mt-1 block w-full" v-model="form.username" autofocus autocomplete="username" />
            <InputError :message="form.errors.username"/>
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Κωδικός" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" autocomplete="current-password" />
            <InputError :message="form.errors.password"/>
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                <span class="ml-2 text-sm text-gray-600">Θυμήσου με</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                Ξεχάσατε τον κωδικό σας;
            </Link>

            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                ΣΥΝΔΕΣΗ
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/FormInputs/Button.vue'
import BreezeCheckbox from '@/Components/FormInputs/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/FormInputs/Input.vue'
import InputError from '@/Components/FormInputs/InputError.vue'
import BreezeLabel from '@/Components/FormInputs/Label.vue'
import BreezeValidationErrors from '@/Components/FormInputs/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
        InputError
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                username: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
