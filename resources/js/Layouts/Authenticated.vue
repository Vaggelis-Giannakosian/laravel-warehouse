<template>
    <a-layout id="components-layout-demo-custom-trigger" class="h-screen overflow-hidden">

        <SideMenu @collapsed="toggleMenu" class="z-10"
                  :class="{
                        'fixed top-0 left-0 bottom-0 transform -translate-x-full' : menuHidden && collapsed,
                        'fixed top-0 left-0 bottom-0 transform translate-x-0': menuHidden && !collapsed
                    }"
                  :collapsed="collapsed"/>

        <a-layout class="bg-gray-300">

            <Header :toggle-menu="toggleMenu" :collapsed="collapsed">
                <template #header>
                    <slot name="header">
                        <nav class="bg-grey-light rounded font-sans w-full leading-tight">
                            <ol class="list-reset flex text-grey-dark mb-0 items-center">
                                <li v-for="(breadcrumb,index) in $page.props.breadcrumbs" :key="index">

                                    <!-- last item -->
                                    <span v-if="index === $page.props.breadcrumbs.length - 1"
                                          v-text="breadcrumb.title"
                                          :class="{'font-bold text-gray-800': $page.props.breadcrumbs.length === 1}"
                                    />

                                    <!-- all other items-->
                                    <span v-else>
                                         <nav-link  :href="breadcrumb.url" class="font-bold text-gray-800">
                                           {{ breadcrumb.title }}
                                         </nav-link>
                                         <span class="mx-1">/</span>
                                    </span>
                                </li>
                            </ol>
                        </nav>

                    </slot>
                </template>
            </Header>

            <!-- Page Content -->
            <a-layout-content class="p-5 overflow-auto">
                <main class="">
                    <slot/>
                </main>
            </a-layout-content>

        </a-layout>

    </a-layout>

    <flash-message/>
</template>

<script>
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import SideMenu from "@/Shared/SideMenu";
import HeaderDropDown from "@/Shared/HeaderDropDown";
import Header from "@/Shared/Header";

export default {
    components: {
        BreezeResponsiveNavLink,
        HeaderDropDown,
        SideMenu,
        Header
    },

    data() {
        return {
            showingNavigationDropdown: false,
            collapsed: false,
            menuHidden: false,
            windowWidth: window.innerWidth
        }
    },
    mounted() {
        if (this.windowWidth < 1000) this.collapsed = true;

        window.onresize = () => {
            this.windowWidth = window.innerWidth
        }
    },
    methods: {
        toggleMenu() {
            this.collapsed = !this.collapsed
        }
    },
    watch: {
        windowWidth(newVal) {
            if (newVal < 1000) {
                this.collapsed = true
            } else {
                this.collapsed = false;
            }

            if (newVal < 500) {
                this.menuHidden = true;
            } else {
                this.menuHidden = false;
            }
        }
    }
}
</script>

<style>
*::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    background-color: white;
    border-radius: 5px;
}

*::-webkit-scrollbar {
    width: 6px;
    height: 5px;
}

*::-webkit-scrollbar-thumb {
    @apply bg-blue-700;
}
</style>
