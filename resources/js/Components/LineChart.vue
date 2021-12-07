<template>
    <div style="max-width: 900px;">
        <h2>Γράφημα διακύμανσης τιμών</h2>
        <p>
            Στο παρακάτω γράφημα παρουσιάζεται η διακύμανση των τιμών του προϊόντος {{ legend }}.
        </p>
        <vue3-chart-js v-bind="lineChart"/>
    </div>
</template>

<script>
import {defineComponent} from 'vue'
import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";
import 'chartjs-adapter-moment';
// import zoomPlugin from "chartjs-plugin-zoom";
// Vue3ChartJs.registerGlobalPlugins([zoomPlugin]);

export default defineComponent({
    name: "LineChart",
    props: ['labels', 'legend', 'dataset'],
    components: {
        Vue3ChartJs
    },
    setup(props) {
        const lineChart = {
            type: "line",
            data: {
                labels: props.labels,
                datasets: [
                    {
                        label: props.legend,
                        data: props.dataset,
                        fill: false,
                        borderColor: "#00D8FF",
                        tension: 0.3,
                        backgroundColor: "blue",
                    },
                ],
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'week',
                            displayFormats: {
                                week: 'DD/MM/YY'
                            }
                        }
                    }
                },
                plugins: {
                    // zoom: {
                    //     zoom: {
                    //         wheel: {
                    //             enabled: true,
                    //         },
                    //         pinch: {
                    //             enabled: true,
                    //         },
                    //         mode: "y",
                    //     },
                    // },
                },
            }
        };

        return {
            lineChart,
        };
    },
})
</script>

<style scoped>

</style>
