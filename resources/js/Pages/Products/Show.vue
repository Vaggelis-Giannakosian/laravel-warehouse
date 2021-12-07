<template>

    <Head title="Προϊόντα"/>

    <BreezeAuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Προϊόν "{{ product.name }}"
            </h2>
        </template>

        <card>
            <div class="text-right mb-3">
                <nav-link :href="route('products.edit',product)">
                    <primary-button>
                        Επεξεργασία
                    </primary-button>
                </nav-link>

                <nav-link :href="route('products.index')">
                    <primary-button>
                        Επιστροφή
                    </primary-button>
                </nav-link>
            </div>

            <ul>
                <li>
                    <strong>Όνομα</strong>: {{ product.name }}
                </li>
                <li>
                    <strong>SKA</strong>: {{ product.ska }}
                </li>
                <li>
                    <strong>Τρέχουσα τιμή</strong>: {{ product.current_price }}
                </li>
                <li>
                    <strong>Ποσότητα</strong>: {{ product.quantity }}
                </li>
                <li>
                    <strong>Κατάσταση</strong>:
                    <span class="px-2 py-1 text-xs font-bold leading-none rounded"
                          v-text="product.status === 'active' ? 'Ενεργό' : 'Ανενεργό'"
                          :class="{'text-green-100 bg-green-700' : product.status === 'active' , 'text-gray-100 bg-gray-500': product.status === 'inactive'}"
                    ></span>
                </li>
                <li>
                    <strong>Κατηγορία</strong>: {{ product.category.name }}
                </li>
                <li>
                    <strong>Προμηθευτής</strong>: {{ product.provider.name }}
                </li>
            </ul>

            <div class="mt-10">
                <LineChart :labels="chartLabels" :dataset="chartDataset" :legend="product.name"/>
            </div>

        </card>

    </BreezeAuthenticatedLayout>


</template>


<script>
import {defineComponent} from 'vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {EditOutlined, DeleteTwoTone, CheckCircleOutlined, CloseCircleOutlined, EyeOutlined} from '@ant-design/icons-vue'
import SearchTable from '@/Components/SearchTable';
import {Head} from '@inertiajs/inertia-vue3';
import LineChart from '@/Components/LineChart'
import moment from 'moment'

moment.locale('el')

export default defineComponent({
    name: 'ProductsIndex',
    props: ['product'],
    components: {
        BreezeAuthenticatedLayout,
        SearchTable,
        EditOutlined, DeleteTwoTone, CheckCircleOutlined, CloseCircleOutlined, EyeOutlined,
        Head, LineChart
    },
    computed: {
        chartLabels() {
            return this.product.prices.map(price => moment(price.datetime))
        },
        chartDataset() {
            return this.product.prices.map(price => {
                return {
                    x: moment(price.datetime),
                    y: price.price
                }
            });
        }
    }
});
</script>
