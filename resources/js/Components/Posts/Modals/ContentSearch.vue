<template>
    <Modal :show="this.state.search">
        <div class="bg-gray-800 p-4 flex flex-col gap-4">
            <div>
                <h1 class="text-white">Search</h1>
            </div>

            <span class="flex">
                <input placeholder="Search Stock Images" type="text" v-model="qurey"
                    class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <button @click="search()" type="button"
                    class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Search
                </button>
            </span>

            <div
                class="h-96 w-full gap-4 flex-wrap p-4 items-center justify-start bg-gray-50 dark:bg-gray-600 border border-gray-30  dark:border-gray-600 dark:placeholder-gray-400 rounded-lg overflow-y-auto grid grid-cols-3">
                <label :id="item.id" class="p-2 px-4 rounded-lg h-auto w-full hover:bg-gray-800 self-stretch" :class="{
        'bg-gray-800': item.checked,
        'bg-gray-950': !item.checked
    }" v-for="(item, name, index) in imageResponse" :key="index">
                    <img :src="item.urls.regular" class="h-full w-full object-contain aspect-video">
                    <input type="checkbox" :name="item.id" :value="item" :id="item.id" v-model="selectedImages"
                        class="hidden" @change="select($event)" />
                </label>
            </div>

            <div class="flex justify-between items-center gap-4 mt-4">
                <button type="button" @click="save()"
                    class=" flex-1 h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Save
                </button>
                <button @click="close()" type="button"
                    class=" flex-1 h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Close
                </button>
            </div>
        </div>
    </Modal>
</template>

<script>
import Modal from "@/Components/Modal.vue";

import axios from "axios";

export default {
    props: ["state"],

    data() {
        return {
            qurey: "",
            imageResponse: {},
            selectedImages: []
        }
    },
    methods: {
        close() { this.state.search = false },
        save() {
            if (this.selectedImages.length == 0) return;
            this.$emit('saveSlectedImages', this.selectedImages);
            this.selectedImages = {};
            this.close();
        },
        search() {
            let params = { qurey: this.qurey }
            const that = this;
            axios.get(route("unsplash.search"), { params })
                .then(response => {
                    that.imageResponse = {};
                    response.data.forEach(item => {
                        item.checked = false;
                        item.origin = "unsplash";
                        that.imageResponse[item.id] = item;
                    });
                }).catch(error => {
                    console.log(error);
                });
        },
        select(e) {
            let element = e.target.id;
            this.imageResponse[element].checked = !this.imageResponse[element].checked;
        }
    },
    components: {
        Modal
    }

}
</script>