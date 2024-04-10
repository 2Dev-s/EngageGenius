<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import FromCard from '@/Components/Posts/FormCard.vue';
import PreviewCard from '@/Components/Posts/PreviewCard.vue';
import { useForm } from '@inertiajs/vue3'

const createFrom = useForm({
    title: '',
    content: '',
    socials: [],
    tags: [],
    files: [],
    dynamicTagsState: false,
    postDate: new Date(),
});

</script>

<template>
    <UserLayout title="Posts">
        <div class="container mx-auto flex flex-col lg:flex-row gap-5 ">
            <FromCard :PostForm="createFrom" FormPostRoute="posts.store"/>
            <PreviewCard :formData="createFrom" />
        </div>
    </UserLayout>
</template>