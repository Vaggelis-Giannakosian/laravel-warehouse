<template>
    <Head title="Services"/>

    <BreezeAuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Επεξεργασία κατηγορίας
            </h2>
        </template>

        <card>
            <div class="p-2 bg-white border-b border-gray-200">
                <div class="flex justify-between">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                        Ενημέρωση κατηγορίας "{{category.name}}"
                    </h2>

                    <nav-link  :href="route('categories.index')">
                        <primary-button>
                            Επιστροφή
                        </primary-button>
                    </nav-link>
                </div>
            </div>

            <Form submit-method="put" :submit-url="route('categories.update',category)"
                  :category="category"/>
        </card>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head} from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/Buttons/PrimaryButton'
import Form from './Form'

export default {
    props:[
        'category'
    ],
    components: {
        BreezeAuthenticatedLayout,
        PrimaryButton,
        Form,
        Head,
    },
}
</script>
