<template>
    <div class="fixed w-full z-30 flex bg-gray-900 p-2 items-center justify-between h-16 px-10">
        <Logo :sideBarState="props.sideBarState"/>
        <div class="flex-none h-full flex items-center justify-center">
            <div class="flex space-x-3 items-center px-3 gap-2">
                <SelectTeamMenu />
                <ProfileMenue />
            </div>
        </div>
    </div>
</template>

<script setup>
import Logo from '@/Components/Layout/Logo.vue';
import SelectTeamMenu from '@/Components/Layout/SelectTeamMenu.vue';
import ProfileMenue from '@/Components/Layout/ProfileMenue.vue';

const props = defineProps(['sideBarState']);

</script>

