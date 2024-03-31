<template>
    <Modal :show="this.state.media">
        <div class="bg-gray-800 p-4 flex flex-col">
            <div class="flex flex-col gap-4">
                <h1 class="text-white">Media</h1>
                <span class="flex">
                    <input placeholder="Image Data" type="text" v-model="qurey"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <button @click="search()" type="button"
                        class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Search
                    </button>
                </span>

                <div
                    class="h-96 w-full gap-4 flex-wrap p-4 items-center justify-start border overflow-y-auto grid grid-cols-3">

                    <div class="bg-gray-900 p-2 px-4 rounded-lg h-24 w-full " v-for="(item, index) in imageResponse"
                        :key="index">
                        <label :for="index">
                            <img :src="item.urls.regular" class="h-full w-full">
                        </label>
                        <input type="checkbox" :name="item.id" :value="item" :id="item.id" v-model="testForm.images" />
                    </div>

                </div>

                <div class="flex justify-between items-center gap-4 mt-4">
                    <button type="button"
                        class=" flex-1 h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Save
                    </button>
                    <button @click="close()" type="button"
                        class=" flex-1 h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </Modal>
</template>

<script>
import Modal from "@/Components/Modal.vue";
import axios from "axios";
import { useForm } from '@inertiajs/vue3';

export default {
    props: ["state"],
    data() {
        return {
            qurey: "",
            imageResponse: [],
            testForm: useForm({
                images: []
            })
        }
    },
    methods: {
        close() {
            this.state.media = false;
        },
        search() {
            let params = {
                qurey: this.qurey
            }

            axios.get(route("unsplash.search"), { params })
                .then(response => {
                    console.log(response.data);
                    this.imageResponse = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
    },
    components: {
        Modal,
    }
}

</script>