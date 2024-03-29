
<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import { ref } from 'vue'

export default {
    props: ["posts"],
    setup() {},
    mounted() {},    
    data: () => ({
        postSearch: "",
        alteredPosts: [],  
        sortedPosts: ref([]),
    }),
    methods: {
        searchPosts() {
            this.sortedPosts = this.alteredPosts.filter((post) => {
                return post.meta.toLowerCase().includes(this.postSearch.toLowerCase());
            });
        },
    },
    mounted() {

        this.alteredPosts = this.posts.map((post)=>{
            post["meta"] = JSON.stringify(post);
            return post;
        });
    
        this.sortedPosts = this.alteredPosts;
    },

    components: {
        UserLayout
    }
}
</script>

<template>
    <UserLayout>
        <div class="container mx-auto gap-4 h-full sm:h-screen flex flex-col">
            <input v-model="postSearch"
                        class="w-full p-5 text-sm text-white ring-0 border-none bg-white border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-5" v-on:input="this.searchPosts()"
                        placeholder="Post Search" required>
            <div class="w-full p-5 text-white ring-0 border-none bg-white border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-full flex flex-col gap-5 overflow-y-auto">
                <div class=" dark:bg-gray-900 dark:border-gray-700 p-2 flex justify-between" v-for="(item, index) in sortedPosts" :key="index">
                    <span class="flex flex-col gap-2">
                        <h2>{{ item.title }}</h2>
                        <p class="w-1/2">{{ item.content.slice(0,100) + "..." }}</p>
  <!--                       <p class="w-1/2">{{"Tags: " + item.tags.slice(0,100) + "..." }}</p> -->
                    </span>
                    <span class="flex flex-col justify-between">
                        <a class="bg-blue-600 px-4 py-2 rounded-md text-center w-24" :href="route('posts.edit',item.id)">Edit</a>
                        <a class="bg-blue-600 px-4 py-2 rounded-md text-center w-24" :href="route('posts.delete',item.id)">Delete</a>
                        <a class="bg-blue-600 px-4 py-2 rounded-md text-center w-24">Publish</a>
                    </span>
                </div>
            </div>
        </div>
    </UserLayout>
</template>

