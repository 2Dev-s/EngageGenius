<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import FromCard from '@/Components/Posts/FormCard.vue';
import PreviewCard from '@/Components/Posts/PreviewCard.vue';
import { useForm } from '@inertiajs/vue3'

</script>

<template>
    <UserLayout title="Posts">
        <div class="container mx-auto flex flex-col lg:flex-row gap-5 ">
            <FromCard :PostForm="FormData" />
            <PreviewCard :formData="FormData" />
        </div>
    </UserLayout>
</template>

<script>

export default {
    props: ['post'],
    data() {
        return {
            FormData: useForm({
                title: '',
                content: '',
                socials: [],
                tags: [],
                files: [],
                dynamicTagsState: false,
                postDate: new Date(),
            }),
        };
    },
    mounted() {
        if (this.post) {
            this.FormData.title = this.post.title;
            this.FormData.content = this.post.content;
            this.FormData.tags = this.post.tags;
            this.FormData.postDate = Date(this.post.published_at);
/*          this.FormData.files = this.Post.files; */
        }
    },
    setup() {
        return {}
    },
}
</script>
