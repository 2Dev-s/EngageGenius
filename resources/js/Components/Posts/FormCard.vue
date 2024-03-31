<template>
    <div
        class="flex flex-1 flex-col p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <form class="flex flex-col gap-4" @submit.prevent="submit">
            <input type="text"
                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Post Title" v-model="PostForm.title">

            <div class="flex justify-center align-center items-center">
                <textarea id="message" rows="4" v-model="PostForm.content"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write your thoughts here..."></textarea>
                <div class="absolute">
                    <svg @click="Modals.textarea = true"
                        class="w-8 h-8 fill-gray-500 dark:fill-gray-400 hover:fill-amber-300 hover:cursor-pointer"
                        viewBox="0 0 256 256" id="Flat" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M208.8584,144a15.85626,15.85626,0,0,1-10.46778,15.01367l-52.16015,19.2168-19.2168,52.16015a16.00075,16.00075,0,0,1-30.02734,0l-19.2168-52.16015-52.16015-19.2168a16.00075,16.00075,0,0,1,0-30.02734l52.16015-19.2168,19.2168-52.16015a16.00075,16.00075,0,0,1,30.02734,0l19.2168,52.16015,52.16015,19.2168A15.85626,15.85626,0,0,1,208.8584,144ZM152,48h16V64a8,8,0,0,0,16,0V48h16a8,8,0,0,0,0-16H184V16a8,8,0,0,0-16,0V32H152a8,8,0,0,0,0,16Zm88,32h-8V72a8,8,0,0,0-16,0v8h-8a8,8,0,0,0,0,16h8v8a8,8,0,0,0,16,0V96h8a8,8,0,0,0,0-16Z" />
                    </svg>
                </div>
            </div>

            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file"
                    class="flex items-center justify-center w-full h-fit border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center  h-full w-full">
                        <template v-if="PostForm.files.length < 1">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400 mt-5 " aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                    to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">SVG, PNG, JPG or GIF (MAX.
                                800x400px)
                            </p>
                        </template>
                        <template v-else>
                            <draggable v-model="PostForm.files" @start="draggablee = true" @end="draggablee = false"
                                item-key="id"
                                class="flex h-full w-full  gap-4 flex-wrap p-4 items-center justify-center">
                                <template #item="{ element }">
                                    <div class=" bg-gray-900 p-2 px-4 rounded-lg flex-2">
                                        <img :src="element.urls.small" class="object-contain h-14 " v-if="element.origin == 'unsplash' ">
                                        <img :src="element.url" class="object-contain h-14 " v-else>
                                    </div>
                                </template>
                            </draggable>
                        </template>
                    </div>


                    <input id="dropzone-file" type="file" class="hidden" v-on:change="handleFileUpload" multiple />
                </label>
            </div>

            <div class="flex justify-between w-full ">
                <svg @click="Modals.search = true"
                    class="w-8 h-8 stroke-gray-500 dark:stroke-gray-500 hover:fill-amber-300 hover:cursor-pointer"
                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg @click="Modals.media = true"
                    class="w-8 h-8 fill-gray-500 dark:fill-gray-400 hover:fill-amber-300 hover:cursor-pointer"
                    viewBox="0 0 256 256" id="Flat" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M208.8584,144a15.85626,15.85626,0,0,1-10.46778,15.01367l-52.16015,19.2168-19.2168,52.16015a16.00075,16.00075,0,0,1-30.02734,0l-19.2168-52.16015-52.16015-19.2168a16.00075,16.00075,0,0,1,0-30.02734l52.16015-19.2168,19.2168-52.16015a16.00075,16.00075,0,0,1,30.02734,0l19.2168,52.16015,52.16015,19.2168A15.85626,15.85626,0,0,1,208.8584,144ZM152,48h16V64a8,8,0,0,0,16,0V48h16a8,8,0,0,0,0-16H184V16a8,8,0,0,0-16,0V32H152a8,8,0,0,0,0,16Zm88,32h-8V72a8,8,0,0,0-16,0v8h-8a8,8,0,0,0,0,16h8v8a8,8,0,0,0,16,0V96h8a8,8,0,0,0,0-16Z" />
                </svg>
            </div>

            <div
                class="flex flex-col sm:flex-row items-center justify-between w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                Dimanyc Tags System API

                <label class="felx items-center cursor-pointer ">
                    <input type="checkbox" value="" class="sr-only peer" v-model="PostForm.dynamicTagsState">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                </label>
            </div>


            <ul
                class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="vue-checkbox-list" type="checkbox" value="twitter" v-model="PostForm.socials"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="vue-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Twitter</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="react-checkbox-list" type="checkbox" value="pinterest" v-model="PostForm.socials"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="react-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pinterest</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="angular-checkbox-list" type="checkbox" value="instagram" v-model="PostForm.socials"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="angular-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Instagram</label>
                    </div>
                </li>
                <li class="w-full dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="laravel-checkbox-list" type="checkbox" value="facebook" v-model="PostForm.socials"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="laravel-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Facebook</label>
                    </div>
                </li>
                <li class="w-full dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input id="laravel-checkbox-list" type="checkbox" value="linkedin" v-model="PostForm.socials"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="laravel-checkbox-list"
                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">LinkedIn</label>
                    </div>
                </li>
            </ul>

            <Vue3TagsInput :tags="PostForm.tags"
                class="flex flex-col sm:flex-row items-center justify-between w-full p-4 text-gray-900 border border-gray-300 rounded-lg  text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Enter post tags" @on-tags-changed="handleChangeTag" />


            <div class="flex gap-5 justify-between content-stretch flex-col lg:flex-row ">
                <VDatePicker v-model="PostForm.postDate" mode="dateTime">
                    <template #default="{ inputValue, inputEvents }">
                        <input :value="inputValue" v-on="inputEvents" type="text"
                            class="flex-1 w-full h-100 text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </template>
                </VDatePicker>
                <span class="flex gap-4 flex-1  ">
                    <button type="button"
                        class=" flex-1  h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Publish</button>
                    <button type="submit"
                        class=" flex-1  h-100 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
                </span>
            </div>
        </form>
    </div>

    <ContentTextarea :state="Modals" :content="PostForm.content" @saveTextarea="textareaSave" :postTitle="PostForm.title"/>
    <ContentMedia :state="Modals" />
    <ContentSearch :state="Modals" @saveSlectedImages="saveSlectedImagesUpslash"/>
</template>

<script>
import draggable from 'vuedraggable'
import ContentTextarea from "@/Components/Posts/Modals/ContentTextarea.vue";
import ContentMedia from "@/Components/Posts/Modals/ContentMedia.vue";
import ContentSearch from "@/Components/Posts/Modals/ContentSearch.vue";

import Vue3TagsInput from 'vue3-tags-input';

export default {
    props: ["PostForm", "FormPostRoute"],
    data() {
        return {
            draggablee: false,
            Modals: {
                textarea: false,
                media: false,
                search: false,
            },
        };
    },

    methods: {
        handleFileUpload(event) {
            for (let i = 0; i < event.target.files.length; i++) {
                let file = {
                    file: event.target.files[i],
                    url: URL.createObjectURL(event.target.files[i]),
                    "origin": "client"
                };
                this.PostForm.files.push(file);
            }
        },

        submit() {
            if (this.PostForm.id) {
                this.PostForm.post(route(this.FormPostRoute, this.PostForm.id), {
                    onSuccess: () => {
                        console.log('success');
                    },
                    onError: (error) => {
                        console.log(error);
                    },
                    onFinish: () => { },
                });
                return;
            }

            this.PostForm.post(route(this.FormPostRoute), {
                onSuccess: () => {
                    console.log('success');
                },
                onError: () => {
                    console.log(error);
                },
                onFinish: () => { },
            });
        },
        
        textareaSave(data) {
            this.PostForm.content = data;
        },

        saveSlectedImagesUpslash(data) {
            if (data.length == 0) return;

            for(let i = 0; i < data.length; i++) {
                this.PostForm.files.push(data[i]);
            }
        },

        handleChangeTag(tags) {
            this.PostForm.tags = tags;
        },
    },
    components: {
        draggable,
        Vue3TagsInput,
        ContentTextarea,
        ContentMedia,
        ContentSearch
    }
}
</script>
