<template>
    <Head title="Dashboard"/>

    <BreezeAuthenticatedLayout>
        <card>
            You're logged in!
        </card>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head} from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
}
</script>
