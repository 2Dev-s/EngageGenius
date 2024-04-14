<template>
    <UserLayout>
        <div class="container mx-auto">
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

                <Card class="w-full dark:bg-gray-800 dark:border-gray-700">
                    <template #content>
                        <DataView :value="props.posts" paginator :rows="10">
                            <template #list="slotProps">
                                <div class="flex flex-wrap">
                                    <div v-for="(item, index) in slotProps.items" :key="index" class="w-full p-3">
                                        {{ item.title }}
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

const props = defineProps(['posts', 'campains', 'socials']);

const searchQuery = ref('');
const publish_date = ref(null);

const campain = ref(0);
const publish_state = ref(false);

const socials = ref([]);
const tags = ref([]);

</script>
