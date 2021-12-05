<template>
    <Head title="Forgot Password" />

    <div class="mb-4 text-sm text-gray-600">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="text" class="mt-1 block w-full" v-model="form.email" autofocus autocomplete="username" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <nav-link :href="route('login')">
                <BreezeButton :class="{ 'opacity-25': form.processing }">
                    Login
                </BreezeButton>
            </nav-link>
            <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Email Password Reset Link
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/FormInputs/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/FormInputs/Input.vue'
import BreezeLabel from '@/Components/FormInputs/Label.vue'
import BreezeValidationErrors from '@/Components/FormInputs/ValidationErrors.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'))
        }
    }
}
</script>
