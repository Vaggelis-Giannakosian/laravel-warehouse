<template>
    <div id="flash-message">
        <!-- Custom template example -->
        <notifications
            group="top-left"
            :duration="3500"
            :width="500"
            animation-name="v-fade-left"
            position="top left"
        >
            <template #body="{ item, close }">
                <div :class="`notification-${item.type} border shadow-lg rounded-b px-4 py-3 shadow-md relative mb-1`"
                     role="alert">
                    <div class="flex items-center">
                        <div class="py-1">
                            <svg :class="`fill-current h-6 w-6 text-${item.data.color}-500 mr-4`" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                            </svg>
                        </div>
                        <div class="mr-2">
                            <p class="font-bold mb-0 mr-2">{{ item.text }}</p>
                        </div>
                        <a  @click="close"  class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg :class="`fill-current h-6 w-6 close-${item.type}`" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </a>
                    </div>
                </div>
            </template>
        </notifications>

        <!-- Full width example -->
        <notifications
            group="full-width"
            width="100%"
        />
    </div>
</template>

<script>
import {mapState} from 'vuex';

export default {
    name: 'FlashMessage',
    data() {
        return {
            id: 0,
            animation: {
                enter: {
                    opacity: [1, 0],
                    translateX: [0, -300],
                    scale: [1, 0.2],
                },
                leave: {
                    opacity: 0,
                    height: 0,
                },
            },
        };
    },
    mounted() {
        if (this.$page.props.flash && this.$page.props.flash.message) {
            const {group, status, message} = this.$page.props.flash.message
            this.show(
                group,
                status,
                message,
            )
        }
    },
    computed: {
        ...mapState([
            'flashMessage'
        ]),
        notificationText() {
            return `This is notification text!
                    <br>
                    Date: ${new Date()}`
        }
    },
    methods: {
        show(group, type = '', text = '') {
            const id = Date.now();
            this.$notify({
                id,
                group,
                text,
                type,
                data: {
                    color: this.getColorByType(type),
                },
            });

            return id;
        },
        clean(group) {
            this.$notify({group, clean: true});
        },
        getColorByType(type){
            const types = {
                'success': 'green',
                'info': 'blue',
                'warning': 'orange',
                'danger' :'red',
            };

            return types[type] || 'green'
        }
    },
    watch: {
        '$page.props.flash': {
            handler(newVal) {
                if (newVal.message) {
                    this.show(newVal.message.group, newVal.message.status, newVal.message.message)
                }
            },
            deep: true
        },
        flashMessage(newVal){
            const {group,status,message} = newVal
            this.show(group||'top-left',status,message)

        }

    }
};
</script>

<style lang="scss" scoped>

.notification-danger{
    @apply bg-red-100 border-red-500 text-red-900;
}
.close-danger{
    @apply text-red-500
}

.notification-success{
    @apply bg-green-100 border-green-500 text-green-900;
}
.close-success{
    @apply text-green-500
}

.notification-warning{
    @apply bg-orange-100 border-orange-500 text-orange-900;
}
.close-warning{
    @apply text-orange-500
}

.notification-info{
    @apply bg-blue-100 border-blue-500 text-blue-900;
}
.close-info{
    @apply text-blue-500
}

.v-fade-left-enter-active,
.v-fade-left-leave-active,
.v-fade-left-move {
    transition: all .5s;
}

.v-fade-left-enter,
.v-fade-left-leave-to {
    opacity: 0;
    transform: translateX(-500px) scale(0.2);
}
</style>
