<template>
    <Head title="Προϊόντα"/>

    <BreezeAuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Επεξεργασία προϊόντος
            </h2>
        </template>

        <card>
            <div class="p-2 bg-white border-b border-gray-200">
                <div class="flex justify-between">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                        Ενημέρωση προϊόντος "{{product.name}}"
                    </h2>

                    <nav-link  :href="route('products.show',product)" class="ml-auto">
                        <primary-button>
                            Προβολή
                        </primary-button>
                    </nav-link>

                    <nav-link  :href="route('products.index')">
                        <primary-button>
                            Επιστροφή
                        </primary-button>
                    </nav-link>
                </div>
            </div>

            <Form submit-method="put" :submit-url="route('products.update',product)"
                  :product="product" :categories="categories" :providers="providers"/>
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
        'product',
        'categories',
        'providers',
    ],
    components: {
        BreezeAuthenticatedLayout,
        PrimaryButton,
        Form,
        Head,
    },
}
</script>
