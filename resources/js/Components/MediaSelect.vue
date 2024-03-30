<template>
    <div class="flex h-full w-full gap-4 flex-wrap p-4 items-center justify-start border">
        <div class=" bg-gray-900 p-2 px-4 rounded-lg flex-2" v-for="(item, index) in images" :key="index">
            <label :for="index">
                <img src="element.url" class="object-contain h-24">
            </label>
            <input type="checkbox" :name="index" :value="index" :id="index" v-model="testForm.images"  >
        </div>
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
