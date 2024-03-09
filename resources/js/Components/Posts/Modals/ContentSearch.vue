<template>
    <Modal :show="this.state.search">
        <div class="bg-gray-800 p-4 flex flex-col">
            <div>
                <h1 class="text-white">Search</h1>
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
    </Modal>
</template>

<script>
import Modal from "@/Components/Modal.vue";

export default {
    props: ["state"],
    methods: {
        close() {
            this.state.search = false;
        }
    },
    components: {
        Modal
    }
    
}
</script>