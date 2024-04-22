<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import { ref } from 'vue'

export default {
    props: ["campains"],
    setup() { },
    mounted() { },
    data: () => ({
        campainSearch: "",
        alteredCampains: [],
        sortedCampains: ref([]),
    }),
    methods: {
        searchPosts() {
            this.sortedCampains = this.alteredCampains.filter((campain) => {
                return campain.meta.toLowerCase().includes(this.campainSearch.toLowerCase());
            });
        },
    },
    mounted() {
        this.alteredCampains = this.campains.map((campain) => {
            campain["meta"] = JSON.stringify(campain);
            return campain;
        });
        this.sortedCampains = this.alteredCampains;
        console.log(this.sortedCampains);
    },
    layout: [UserLayout],
    components: {
        UserLayout
    }
}
</script>

<template>

    <div class="container mx-auto gap-4 h-full sm:h-screen flex flex-col">
        <input v-model="campainSearch"
            class="w-full p-5 text-sm text-white ring-0 border-none bg-white border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-5"
            v-on:input="this.searchPosts()" placeholder="Campain Search" required>
        <div
            class="w-full p-5 text-white ring-0 border-none bg-white border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-full flex flex-col gap-5 overflow-y-auto">
            <div class=" dark:bg-gray-900 dark:border-gray-700 p-2 flex justify-between"
                v-for="(item, index) in sortedCampains" :key="index">
                <span class="flex flex-col gap-2">

                    <h2>{{ item.title }}</h2>
                    <p>{{ item.nich }}</p>

                    <p class="w-1/2">{{ item.description.slice(0, 100) + "..." }}</p>
                    <p class="w-1/2">{{ item.product_description.slice(0, 100) + "..." }}</p>
                    <p class="w-1/2">{{ item.product_features.slice(0, 100) + "..." }}</p>


                </span>
                <span class="flex flex-col justify-between">
                    <a class="bg-blue-600 px-4 py-2 rounded-md text-center w-24"
                        :href="route('campains.edit', item.id)">Edit</a>
                    <a class="bg-blue-600 px-4 py-2 rounded-md text-center w-24"
                        :href="route('campains.delete', item.id)">Delete</a>
                    <a class="bg-blue-600 px-4 py-2 rounded-md text-center w-24"
                        :href="route('campains.generate.post', item.id)">Generate</a>
                </span>
            </div>
        </div>
    </div>

</template>
