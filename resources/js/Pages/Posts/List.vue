
<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import { ref } from 'vue'

export default {
    props: {
        posts: Array,
    },

    setup() {},

    mounted() {},    
    data: () => ({
        postSearch: "",
        sortedPosts: ref([]),
    }),
    methods: {
        searchPosts() {
            this.sortedPosts = this.posts.filter((post) => {
                return post.title.toLowerCase().includes(this.postSearch.toLowerCase());
            });
        },
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
                        class="w-full p-5 text-sm text-white ring-0 border-none rounded-full bg-black bg-opacity-50 h-5" v-on:input="searchPosts"
                        placeholder="Post Search" required>
            <div class="w-full p-5 text-white ring-0 border-none rounded-sm bg-black bg-opacity-50 h-full">
                <div v-for="(item, index) in sortedPosts" :key="index">
                    {{ item.toString() }}
                </div>
            </div>
        </div>
    </UserLayout>
</template>

