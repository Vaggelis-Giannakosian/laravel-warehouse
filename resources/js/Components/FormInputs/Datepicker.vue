<template>
    <a-date-picker placeholder="Επιλέξτε ημερομηνία"
                   @change="onChange"
                   @ok="onOk"
                   :locale="locale"
                   :show-time="{ format: 'HH:mm' }"
                   class="datepicker"
                   format="DD/MM/YYYY HH:mm"
                   :value="date"
    />
</template>

<script>
import {defineComponent} from 'vue'
import locale from 'ant-design-vue/es/date-picker/locale/el_GR';

export default defineComponent({
    name: "Datepicker",
    props:['date'],
    setup(props,context){

        const onChange = (value, dateString) => {
            context.emit('update:date',value)
        };

        const onOk = (value) => {
            context.emit('update:date',value)
        };

        return {
            onChange,
            onOk,
            locale
        };
    },
})
</script>

<style>
    .datepicker .ant-input{
        @apply py-2 rounded leading-6;
    }
</style>
