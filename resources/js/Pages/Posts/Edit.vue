<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import FromCard from '@/Components/Posts/FormCard.vue';
import PreviewCard from '@/Components/Posts/PreviewCard.vue';
import { useForm } from '@inertiajs/vue3'
import { onMounted } from 'vue';

const props = defineProps(['post']);
defineOptions({ layout: UserLayout });

const EditForm = useForm({
    id: null,
    title: '',
    description: '',
    socials: [],
    tags: [],
    files: [],
    api_tags: false,
    publish_date: new Date(),
});


const submitFunction = () => {
    if(!props.post.id || !EditForm.id) return;
    EditForm.post(route('posts.update', props.post.id), {
        onSuccess: () => {
            console.log('success');
        },
        onError: (error) => {
            console.log(error);
        },
        onFinish: () => { },
    })


}

onMounted(() => {
    if (props.post) {
        let post = props.post;
        EditForm.id = post.id;
        EditForm.title = post.title;
        EditForm.description = post.description;
        EditForm.tags = post.tags;
        EditForm.publish_date = Date(post.publish_date);
        EditForm.socials = post.socials;
        
        EditForm.files = post.files.map((file) => {
            let newFile = file;
            newFile["origin"] = "server";
            newFile["url"] = "/storage/" + file.path;
            return newFile;
        });

        EditForm.files.sort((a, b) => a.order - b.order);

    }
})

</script>

<template>
        <div class="container mx-auto flex flex-col lg:flex-row gap-5 ">
            <FromCard :PostForm="EditForm" FormPostRoute="posts.update" @submitForm="submitFunction()" />
            <PreviewCard :formData="EditForm" />
        </div>
</template>
