<template>
        <Multiselect
            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            ref="input"
            :searchable="searchable"
            :modelValue="modelValue"
            @input="$emit('update:modelValue', $event)"
            :options="options"
        />
</template>

<script>
import Multiselect from '@vueform/multiselect'

export default {
    props: ['modelValue','options','searchable'],
    emits: ['update:modelValue'],
    components:{
        Multiselect
    },
    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
<style>
    .multiselect-option.is-selected {
        background: #e8f0fe!important;
        color: black!important;
    }
</style>
