<template>
    <Modal :show="this.state.textarea">
        <div class="bg-gray-800 p-4 flex flex-col justify-center">

            <span class="flex flex-col gap-4">
                <div>
                    <textarea name="" id="" cols="10" rows="10" placeholder="Old Description" v-model="FormData.old"
                    class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>

                    <textarea name="" id="" cols="10" rows="10" placeholder="Post Data"
                    class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
            </span>

            <span class="flex gap-2 py-4 justify-between w-full">
                <button
                    class="flex-1 h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Generate
                    Desciption (Old)</button>
                <button
                    class="flex-1 h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Generate
                    Desciption (Data)</button>
                <button
                    class="flex-1 h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Generate
                    Desciption (Data + Old)</button>
                <button @click="fetch()"
                    class="flex-1 h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Regenerate
                    Desciption</button>
            </span>

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
    </Modal>
</template>

<script>
import Modal from "@/Components/Modal.vue";

export default {
    props: ["state", "content"],
    data: () => ({
        FormData: {
            old: "",
            data: ""
        }        
    }),
    mounted: () => {fetch()},
    methods: {
        close() {
            this.state.textarea = false;
        },
        fetch(){
            this.FormData.old = this.content;
        }
    },
    components: {
        Modal
    }
}
</script>