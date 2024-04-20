<template>
    <aside class="w-60 bg-gray-900 p-4 fixed transition transform ease-in-out duration-1000 z-50 flex h-screen" :class="{
        '-translate-x-48': !props.state,
        'translate-x-0': props.state,
    }">

        <div class="w-full transition transform ease-in duration-300 flex items-center justify-between border-4 border-none absolute top-2 rounded-full h-12"
            :class="{
                'translate-x-30': props.state,
                'translate-x-0': !props.state,
                'scale-x-0': !props.state,
            }">

            <div class="flex pl-4 items-center space-x-2 ">
                <div class="text-white font-extrabold text-xl">
                    <Link :href="route('home')">
                        {{ app_name }}
                    </Link>
                </div>
            </div>
        </div>

        <ToggleSIdeBarButton :state="props.state" @toggle-sidebar="emit('toggle-sidebar')" />

        <div class="mt-20 flex-col space-y-2 w-full h-[calc(100vh)] flex">

            <Link v-for="link in Links" :key="link.id" :href="route(link.route)" v-if="props.state"
                class="flex items-center p-2 text-white rounded-lg bg-gray-800 hover:bg-gray-950 group transition-all">
            <span class="w-6 h-6 transition duration-75 group-hover:text-gray-500 text-center py-0.5">
                <i :class="{
                    [link.icon]: true,
                }"></i>
            </span>
            <span class="ms-3">{{ link.name }}</span>
            </Link>

            <Link v-for="link in Links" :href="route(link.route)" v-else
                class="hover:ml-8 justify-end  ml-2 text-white w-full bg-gray-800 p-3 rounded-lg shadow-xl transform ease-in-out duration-300 flex">
            <span class="w-6 h-6 transition duration-75 group-hover:text-gray-500 text-center py-0.5 ">
                <i :class="{
                    [link.icon]: true,
                }"></i>
            </span>
            </Link>
        </div>

    </aside>
</template>

<script setup>
import { ref } from 'vue';
import ToggleSIdeBarButton from '@/Components/Layout/Sidebar/ToggleSIdeBarButton.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['state']);
const emit = defineEmits(['toggle-sidebar']);

const app_name = import.meta.env.VITE_APP_NAME;

const Links = [
    {
        name: 'Home',
        route: 'home',
        icon: 'pi pi-home',
    },
    {
        name: 'Mini Shop',
        route: 'minishop',
        icon: 'pi pi-shopping-cart',
    },
    {
        name: 'Orders',
        route: 'minishop.orders',
        icon: 'pi pi-shopping-bag',
    },
    {
        name: 'Short URL',
        route: 'shorturl',
        icon: 'pi pi-link',
    },
    {
        name: 'Pricing',
        route: 'pricing',
        icon: 'pi pi-money-bill',
    },
    {
        name: 'Posts',
        route: 'posts',
        icon: 'pi pi-file',
    },
];
</script>

<style lang="scss" scoped></style>