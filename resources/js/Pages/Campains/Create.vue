<template>
    <UserLayout>
        <div class="container mx-auto flex flex-col gap-5">
            <FormCard :FormData="FormData" :templates="promptTamplates"/>
            <div class="flex justify-end gap-4">
<!--                 <button class="px-6 py-2 bg-blue-700 rounded-md" @click="submitForm" type="button"> Generate
                    Campain</button> -->
                <button class="px-6 py-2 bg-blue-700 rounded-md" @click="submitForm" type="button"> Save
                    Campain</button>
            </div>
        </div>
    </UserLayout>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import FormCard from '@/Components/Campains/FormCard.vue';
import { useForm } from '@inertiajs/vue3'

export default {
    props: ["promptTamplates"],
    setup() {
        return {}
    },
    data() {
        return {
            FormData: useForm({
                title: '',
                description: '',
                niche: '',
                tamplate_id: null,
                product_features: '',
                product_description: '',
                image_data: '',
                posts: null,
                discount: null,
                cta_text: '',
                redirect_link: '',
                start_date: null,
                end_date: null,
            })
        }
    },
    methods: {
        submitForm() {
            this.FormData.post(route('campains.store'))
        }
    },
    components: {
        UserLayout,
        FormCard
    }
}
</script>
