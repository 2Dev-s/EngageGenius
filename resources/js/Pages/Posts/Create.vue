<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import FromCard from '@/Components/Posts/FormCard.vue';
import PreviewCard from '@/Components/Posts/PreviewCard.vue';
import { useForm } from '@inertiajs/vue3'

const createFrom = useForm({
    title: '',
    description: '',
    socials: [],
    tags: [],
    files: [],
    api_tags: false,
    publish_date: new Date(),
});

const submitFunction = () => {
    createFrom.post(route('posts.store'), {
        onSuccess: () => {
            console.log('success');
        },
        onError: (error) => {
            console.log(error);
        },
        onFinish: () => { },
    });
}

</script>

<template>
    <UserLayout title="Posts">
        <div class="container mx-auto flex flex-col lg:flex-row gap-5 ">
            <FromCard :PostForm="createFrom" FormPostRoute="posts.store" @submitForm="submitFunction()" />
            <PreviewCard :formData="createFrom" />
        </div>
    </UserLayout>
</template>