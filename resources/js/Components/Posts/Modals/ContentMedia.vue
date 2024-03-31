<template>
    <Modal :show="this.state.media">
        <div class="bg-gray-800 p-4 flex flex-col">
            <div class="flex flex-col gap-4">
                <h1 class="text-white">Media</h1>
                <span class="flex flex-col justify-end items-end">
                    <textarea placeholder="Image Data" type="text" v-model="imageData"
                        class="block w-full p-4 h-40 max-h-40 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 overflow-y-auto">
                    </textarea>
                    <button @click="generate()" type="button"
                        class="w-1/3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Search
                    </button>
                </span>

                <div
                    class="h-96 w-full items-center justify-center overflow-hidden bg-gray-50 dark:bg-gray-700 border border-gray-30  dark:border-gray-600 dark:placeholder-gray-400 rounded-lg overflow-y-auto ">
                        <img class="h-full w-full object-contain" :src="imageResponse"/>
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
            imageData: "",
            imageResponse: [],
    }},
    methods: {
        close() {
            this.state.media = false;
        },
        save() {
            if (this.imageResponse == []) return;

            let photo = {
                url: this.imageResponse,
                "origin" : "openai"
            }

            this.$emit("savePhoto", photo);
            this.close();
        },
        generate() {
            let params = { imageData: this.imageData }
            axios.get(route("openai.post.create"), { params })
                .then(response => {
                    this.imageResponse = "data:image/png;base64," + response.data[0]["b64_json"];
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