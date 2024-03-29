<template>
    <div
        class="flex w-full h-96 p-4 gap-4 flex-wrap justify-center align-top overflow-y-auto text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <span class="w-full flex-1  bg-black" v-for="(item, index) in images" :key="index">

        </span>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3'

export default {
    data() {
        return {
            images: [1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
            testForm: useForm({
                images: []
            })
        }
    },
    setup() {
        return {}
    }
}
</script>
