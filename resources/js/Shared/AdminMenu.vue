<template>
    <a-menu theme="light"
            mode="inline"
            :selected-keys="[current]"
            @click="handleClick"
    >
        <a-menu-item key="dashboard">

            <div class="flex items-center">
                <DashboardOutlined class="mr-3"/>

                <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    {{'Dashboard'}}
                </BreezeNavLink>
            </div>

        </a-menu-item>

    </a-menu>
</template>

<script>
import BreezeNavLink from '@/Components/NavLink.vue'
import {DashboardOutlined, UsergroupAddOutlined, UserOutlined, ShoppingOutlined, ShopOutlined} from '@ant-design/icons-vue'

export default {
    name: "Admin",
    props:['current','handleClick'],
    components:{
        BreezeNavLink,
        DashboardOutlined, UsergroupAddOutlined, UserOutlined, ShoppingOutlined, ShopOutlined
    }
}
</script>

<style scoped>

</style>
