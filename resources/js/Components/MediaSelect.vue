<template>
    <div class="h-96 w-full gap-4 flex-wrap p-4 items-center justify-start border overflow-y-auto grid grid-cols-3">
        <div class="bg-gray-900 p-2 px-4 rounded-lg h-24 w-full " v-for="(item, index) in images" :key="index">
            <label :for="index">
                <img src="element.url" class="h-full w-full">
            </label>
            <input type="checkbox" :name="index" :value="index" :id="index" v-model="testForm.images" />
        </div>
    </div>
    <button @click="test()">Test</button>
</template>

<script>
import { useForm } from '@inertiajs/vue3'

export default {
    props: {
        images: Array
    },
    data() {
        return {
            testForm: useForm({
                images: []
            })
        }
    },
    methods: {
        test() {
            console.log(this.testForm.images)
        }
    },
    setup() {
        return {}
    }
}
</script>
