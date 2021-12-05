<template>
    <Head title="Forgot Password" />

    <div class="mb-4 text-sm text-gray-600">
        Ξεχάσατε τον κωδικό σας; Κανένα πρόβλημα. Δώστε μας το email σας και θα σας στείλουμε έναν σύνδεσμο ανάκτησης κωδικού που θα σας επιτρέψει να τον επαναφέρετε.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="text" class="mt-1 block w-full" v-model="form.email" autofocus autocomplete="username" />
            <InputError :message="form.errors.email"/>
        </div>

        <div class="flex items-center justify-between mt-4">
            <nav-link :href="route('login')">
                <BreezeButton :class="{ 'opacity-25': form.processing }">
                    ΣΥΝΔΕΣΗ
                </BreezeButton>
            </nav-link>
            <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                ΕΠΑΝΑΦΟΡΑ ΚΩΔΙΚΟΥ
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/FormInputs/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/FormInputs/Input.vue'
import InputError from '@/Components/FormInputs/InputError.vue'
import BreezeLabel from '@/Components/FormInputs/Label.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        InputError,
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
