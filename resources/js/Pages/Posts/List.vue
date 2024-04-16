<template>
    <UserLayout>
        <div class="container mx-auto h-fit">
            <div class="flex flex-col gap-4 h-full sm:h-screen">
                <div class="flex flex-col items-center gap-4 mt-5">
                    <InputText placeholder="Search" id="searchQ"
                        class="pl-10 w-full dark:bg-gray-800 dark:border-gray-700" v-model="searchQuery" />

                    <div class="flex w-full gap-5 align-middle justify-center flex-wrap">
                        <Calendar v-model="publish_date" selectionMode="range" :manualInput="false" class="flex-2" :pt="{
                            input: 'dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 rounded h-12',
                            panel: 'dark:bg-gray-800 dark:border-gray-700 text-white',
                        }" />
                        <Dropdown :options="props.campains" optionLabel="title" optionValue="id" v-model="campain"
                            placeholder="Select a Campain" class="dark:bg-gray-800 dark:border-gray-700 h-12" :pt="{
                                panel: 'dark:bg-gray-800 dark:border-gray-700 text-white overflow-y-auto rounded-b-lg ',
                            }" />
                        <MultiSelect placeholder="Select Socials" :options="props.socials" v-model="socials"
                            display="chip" class="dark:bg-gray-800 dark:border-gray-700 h-12" :pt="{
                                panel: 'dark:bg-gray-800 dark:border-gray-700 text-white',
                                wrapper: 'overflow-y-auto'
                            }" />
                        <ToggleButton onLabel="Published" offLabel="Not Published"
                            class="dark:bg-gray-800 dark:border-gray-700 h-12" v-model="publish_state" />
                        <Chips v-model="tags" class="dark:bg-gray-800 dark:border-gray-700 h-12" />
                    </div>
                </div>

                <Card class="w-full dark:bg-gray-900 dark:border-gray-700">
                    <template #content>
                        <DataView :value="props.posts" paginator :rows="10">
                            <template #list="slotProps">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <div v-for="(item, index) in slotProps.items" :key="index"
                                        class="w-full p-3 grid grid-cols-8 border rounded-lg dark:bg-gray-800 dark:border-gray-800 bg-opacity-5 shadow-md gap-4">

                                        <div
                                            class="rounded-lg overflow-hidden w-full h-full  col-span-2 flex flex-col items-center align-middle">
                                            <img src="https://placehold.co/600x400" alt="" class="w-full object-fill"
                                                width="300" height="200">
                                        </div>

                                        <div class="flex flex-col w-full flex-1 gap-2 col-span-5">
                                            <p>{{ item.title }}</p>
                                            <p class="w-2/3">{{ item.description.slice(0, 300) + " ..." }}</p>
                                            <span class="flex gap-2">
                                                <Chip class="flex">
                                                    <span
                                                        class="text-surface-0  rounded-full w-fit px-2 flex items-center justify-center bg-slate-600 z-10 text-white">Publish
                                                        Date</span>
                                                    <span
                                                        class="text-surface-0  rounded-full rounded-s-none h-8 flex items-center justify-center w-fit bg-blue-700 px-5 -ml-4">{{
                                                            item.publish_date }}</span>
                                                </Chip>
                                                <Chip class="flex">
                                                    <span :class="{
                                                        'bg-green-600': item.publish_state,
                                                        'bg-red-600': !item.publish_state
                                                    }"
                                                        class="text-surface-0 rounded-full w-8 h-8 flex items-center justify-center z-10 ">
                                                        <icon>
                                                            <i class="pi pi-check" v-if="item.publish_state"></i>
                                                            <i class="pi pi-times" v-else></i>
                                                        </icon>
                                                    </span>
                                                    <span
                                                        class="font-medium bg-slate-600 px-5 flex items-center rounded-full rounded-s-none justify-center -ml-3  text-white">Published</span>
                                                </Chip>
                                            </span>
                                            <Chip class="flex">
                                                <span
                                                    class="rounded-full w-fit px-2 flex items-center justify-center bg-slate-600 z-10 text-white">Campain</span>
                                                <span
                                                    class="rounded-s-none rounded-full w-fit px-4 flex items-center justify-center bg-orange-700 -ml-2 text-black">{{
                                                        getCampainName(item.campain_id) }}</span>
                                            </Chip>
                                            <span class="flex gap-2 flex-wrap">
                                                <Tag value="Twitter" v-if="item.post_to_twitter" />
                                                <Tag value="Twitter" icon="pi pi-twitter" v-else class="bg-blue-600"
                                                    :pt="{ 'value': 'text-bold text-white ml-2' }" />
                                                <Tag value="Pinterest" v-if="item.post_to_pinterest" />
                                                <Tag value="Pinterest" icon="pi pi-pinterest" v-else
                                                    class="bg-red-900 text-white"
                                                    :pt="{ 'value': 'text-bold text-white ml-2' }" />
                                                <Tag value="Facebook" v-if="item.post_to_facebook" />
                                                <Tag value="Facebook" icon="pi pi-facebook" v-else class="bg-blue-600"
                                                    :pt="{ 'value': 'text-bold ml-2' }" />
                                                <Tag value="Instagram" v-if="item.post_to_instagram" />
                                                <Tag value="Instagram" icon="pi pi-instagram" v-else
                                                    class="bg-gradient-to-br from-pink-500  via-red-500 to-yellow-500"
                                                    :pt="{ 'value': 'text-bold ml-2' }" />
                                                <Tag value="LinkedIn" v-if="item.post_to_linkedin" />
                                                <Tag value="LinkedIn" icon="pi pi-linkedin" v-else class="bg-blue-500"
                                                    :pt="{ 'value': 'font-bold ml-2' }" />
                                            </span>
                                        </div>
                                        <div class="flex items-center col-span-1">
                                            <SpeedDial :model="makeSpeedDialData(item)" :radius="75" type="semi-circle"
                                                :tooltipOptions="{ position: 'right' }" showIcon="pi pi-bars"
                                                buttonClass="bg-blue-700 border-0 text-white" direction="right" :pt="{
                                                    menuitem: ({ props, context }) => ({
                                                        class: [
                                                            'transform transition-transform duration-200 ease-out transition-opacity duration-800 bg-blue-800 text-white rounded-full',
                                                            // Conditional Appearance
                                                            context.hidden ? 'opacity-0 scale-0' : 'opacity-100 scale-100',
                                                            // Conditional Spacing
                                                            {
                                                                'my-1 first:mb-2': props.direction == 'up' && props.type == 'linear',
                                                                'my-1 first:mt-2': props.direction == 'down' && props.type == 'linear',
                                                                'mx-1 first:mr-2': props.direction == 'left' && props.type == 'linear',
                                                                'mx-1 first:ml-2': props.direction == 'right' && props.type == 'linear'
                                                            },
                                                            // Conditional Positioning
                                                            { absolute: props.type !== 'linear' }
                                                        ]
                                                    }),
                                                }" />
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </DataView>
                    </template>
                </Card>
            </div>

        </div>
    </UserLayout>
</template>


<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import { onMounted, ref } from 'vue'

import DataView from 'primevue/dataview';
import Card from 'primevue/card';
import Chips from 'primevue/chips';

import Calendar from 'primevue/calendar';
import MultiSelect from 'primevue/multiselect';
import ToggleButton from 'primevue/togglebutton';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';

import SpeedDial from 'primevue/speeddial';
import Tag from 'primevue/tag';

const props = defineProps(['posts', 'campains', 'socials']);

const searchQuery = ref('');
const publish_date = ref(null);

const campain = ref(0);
const publish_state = ref(false);

const socials = ref([]);
const tags = ref([]);

const makeSpeedDialData = (post) => {
    return [
        { label: 'Delete Post', icon: 'pi pi-trash', command: () => { window.location = route("posts.delete", post.id) } },
        { label: 'Publish Post', icon: 'pi pi-send', command: () => { console.log('Publish') } },
        { label: 'Edit Post', icon: 'pi pi-pencil', command: () => { window.location = route("posts.edit", post.id) } },

    ];
}

const getCampainName = (id) => {
    let campainTitle = props.campains.find(campain => campain.id === id).title;
    if (campainTitle) {
        return campainTitle;
    }

    return "No Campain";
}
</script>
