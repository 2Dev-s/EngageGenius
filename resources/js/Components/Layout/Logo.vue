<template>
    <div class="logo transform ease-in-out duration-500 flex-none h-full flex items-center justify-center text-white font-extrabold"
        :class="{
            'ml-12': !props.sideBarState,
        }">
        <a :href="route('home')">
            {{ app_name }}
        </a>
    </div>
</template>

<script setup>
const app_name = import.meta.env.VITE_APP_NAME;

const props = defineProps(['sideBarState']);
</script>