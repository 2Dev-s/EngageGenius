<template>

    <div class="container mx-auto flex flex-col gap-5">
        <FormCard :FormData="FormData" :templates="promptTamplates" />
        <div class="flex justify-end gap-4">
            <!--                 <button class="px-6 py-2 bg-blue-700 rounded-md" @click="submitForm" type="button"> Generate
                    Campain</button> -->
            <button class="px-6 py-2 bg-blue-700 rounded-md" @click="submitForm" type="button"> Save
                Campain</button>
        </div>
    </div>

</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import FormCard from '@/Components/Campains/FormCard.vue';
import { useForm } from '@inertiajs/vue3'

export default {
    props: ["campain", "promptTamplates"],
    setup() {
        return {}
    },
    layout: [UserLayout],
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
                posts_count: null,
                discount: null,
                cta_text: '',
                redirect_link: '',
                start_date: null,
                end_date: null,
            })
        }
    },
    mounted() {
        this.FormData.title = this.campain.title
        this.FormData.description = this.campain.description
        this.FormData.posts_count = this.campain.posts_count
        this.FormData.niche = this.campain.niche
        this.FormData.tamplate_id = this.campain.tamplate_id
        this.FormData.product_features = this.campain.product_features
        this.FormData.product_description = this.campain.product_description
        this.FormData.image_data = this.campain.image_data
        this.FormData.discount = this.campain.discount
        this.FormData.cta_text = this.campain.cta_text
        this.FormData.redirect_link = this.campain.redirect_link
        this.FormData.start_date = this.campain.start_date
        this.FormData.end_date = this.campain.end_date

    },
    methods: {
        submitForm() {
            this.FormData.post(route('campains.update', this.campain.id))
        }
    },
    components: {
        UserLayout,
        FormCard
    }
}
</script>
