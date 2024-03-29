<template>
    <Modal :show="this.state.textarea">
        <div class="bg-gray-800 p-4 flex flex-col justify-center">

            <span class="flex flex-col gap-4">
                <div class="flex flex-col items-end gap-2">
                    <textarea name="" id="" cols="10" rows="10" placeholder="Description" v-model="FormData.old"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    <button @click="fetch()" class="w-1/3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" >Fetch Post Desciption</button>
                </div>

                <textarea name="" id="" cols="10" rows="10" placeholder="Post Data"
                    class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
            </span>

            <span class="flex gap-2 py-4 justify-between w-full">
                <button
                    class="flex-1 h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    @click="createNewDesciption()">Generate
                    Desciption (Old)</button>
                <button
                    class="flex-1 h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" 
                    @click="createNewDesciptionFromData()">Generate
                    Desciption (Data)</button>
                <button
                    class="flex-1 h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    @click="createNewDesciptionFromDataPlusOldDesciption()" >Generate
                    Desciption (Data + Old)</button>

            </span>

            <div class="flex justify-between items-center gap-4 mt-4">
                <button type="button" @click="onSave()"
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
import { useForm } from '@inertiajs/vue3'
import axios from 'axios';

export default {
    props: ["state", "content", "postTitle"],
    data: () => ({
        FormData: useForm({
            old: "",
            data: ""
        })
    }),
    mounted: () => { fetch() },
    methods: {
        close() {
            this.state.textarea = false;
        },
        onSave() {
            this.$emit('saveTextarea', this.FormData.old);
            this.close();
        },
        fetch() {
            this.FormData.old = this.content;
        },
        createNewDesciption() {
            let compData = this;
            if (compData.postTitle == "") return;

            const params = { postTitle: compData.postTitle};
            axios.get(route('openai.create.post.description'), { params })
                .then(function (response) {
                    compData.FormData.old = response.data;
                });
        },

        createNewDesciptionFromData() {
            let compData = this;
            if (compData.FormData.data == "") return;

            const params = { postTitle: compData.postTitle, postData: compData.FormData.data};
            axios.get(route('openai.create.post.description'), { params })
                .then(function (response) {
                    compData.FormData.old = response.data;
                });
        },

        createNewDesciptionFromDataPlusOldDesciption() {
            let compData = this;
            if (compData.FormData.old == "") return;
            const params = { postTitle: compData.postTitle, postData: compData.FormData.data, postOldDesciption: compData.FormData.old};
            axios.get(route('openai.create.post.description'), { params })
                .then(function (response) {
                    compData.FormData.old = response.data;
                });
        }
    },
    components: {
        Modal
    }
}
</script>