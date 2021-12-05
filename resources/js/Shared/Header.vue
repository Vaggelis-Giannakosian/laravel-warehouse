<template>
    <!-- Page Heading -->
    <a-layout-header class="bg-white px-4 xl:px-5 items-center w-100">

        <div class="flex items-center w-100 mt-3 sm:mt-0 justify-end ">
            <MenuUnfoldOutlined v-if="collapsed" @click="toggleMenu"/>
            <MenuFoldOutlined  v-else @click="toggleMenu" />

            <div class="bg-white flex items-center" v-if="$slots.header">
                <div class="mx-auto py-2 px-4 pr-0">
                    <slot name="header"/>
                </div>
            </div>

            <HeaderDropDown/>
        </div>

    </a-layout-header>
</template>

<script>
import HeaderDropDown from "@/Shared/HeaderDropDown";
import {MenuFoldOutlined,MenuUnfoldOutlined} from '@ant-design/icons-vue'

export default {
    name: "Header",
    props: ['toggleMenu','collapsed'],
    components:{
        HeaderDropDown,
        MenuFoldOutlined,
        MenuUnfoldOutlined
    }
}
</script>

<style scoped lang="scss">
.ant-layout-header {

    .anticon {
        margin-top: 5px;

        @media (max-width: 640px) {
            order: 2;
            margin-left: 10px;
        }

    }

}
</style>
