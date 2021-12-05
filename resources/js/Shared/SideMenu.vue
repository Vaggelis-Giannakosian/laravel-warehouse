<template>
    <a-layout-sider theme="light" width="220"  class="shadow" :collapsed="collapsed" @collapse="$emit('collapsed')"  collapsible>

        <div style="max-width: 210px; margin: 4px auto;">
            <Link :href="route('dashboard')" class="block">
                <BreezeApplicationLogo/>
            </Link>
        </div>

        <!-- Dynamic MENU-->
        <component :is="activeMenu" :current="current" :handle-click="handleClick"/>

        <div class="mt-auto flex flex-col text-center bottom_handlers">
            <BreezeDropdown align="right" width="48" v-if="!collapsed">
                <template #trigger>
                    <UserOutlined class="cursor-pointer"/>
                </template>

                <template #content>
                    <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                        {{'Αποσύνδεση'}}
                    </BreezeDropdownLink>
                </template>
            </BreezeDropdown>

        </div>


    </a-layout-sider>
</template>

<script>
import BreezeNavLink from '@/Components/NavLink.vue'
import { Link } from '@inertiajs/inertia-vue3';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdownLink from '@/Components/DropdownLink'
import BreezeDropdown from '@/Components/Dropdown'
import AdminMenu from './AdminMenu'
import {UserOutlined} from '@ant-design/icons-vue'

export default {
    name: "SideMenu",
    props:['collapsed'],
    components: {
        UserOutlined,
        BreezeApplicationLogo,
        BreezeNavLink,
        BreezeDropdownLink,
        BreezeDropdown,
        Link,
        AdminMenu
    },
    computed:{
        current(){
            return route().current('').split('.')[0];
        },
        activeMenu(){
            return 'AdminMenu'
        }
    },
    methods: {
        handleClick(e) {
            this.current = e.key;
        },
    },
}
</script>

<style lang="scss">

aside {


    &.ant-layout-sider .ant-layout-sider-children{
        display: flex;
        flex-direction: column;
    }

    .ant-menu-inline-collapsed {

        a {
            width: 0 !important;
            visibility: hidden;
        }
    }

    .ant-layout-sider-trigger {
        border-top: 1px solid #0000001a;
    }


    .bottom_handlers{

        @media (min-width: 640px){
            display: none!important;
        }
    }

}

.ant-tooltip .ant-tooltip-content a{
    color:white!important;
}
</style>
