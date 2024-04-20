<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import { createCalendar, viewMonthGrid } from '@schedule-x/calendar'
import '@schedule-x/theme-default/dist/index.css'

import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';

export default {
    props: {
        posts: Array,
        campaigns: Array,
    },
    layout: [UserLayout],
    data: () => ({
        calendar: null,
        calendarCampain: null,
        calendarEvents: [],
        calendarCampainEvents: [],
    }),
    setup() {
        const calendarRef = ref(null);
        const calendarCampainRef = ref(null);
        return {
            calendarRef,
            calendarCampainRef
        }
    },
    mounted() {

        if (this.posts.length > 0) {
            this.calendarEvents = this.posts.map((post) => {
                return {
                    id: post.id,
                    title: post.title,
                    description: post.description,
                    start: post.publish_date,
                    end: post.publish_date,
                }
            });
        };

        if (this.campaigns.length > 0) {
            this.calendarCampainEvents = this.campaigns.map((campain) => {
                return {
                    id: campain.id,
                    title: campain.title,
                    description: campain.description,
                    start: campain.start_date,
                    end: campain.end_date,
                }
            });
        };

        this.calendar = createCalendar({
            isDark: true,
            views: [viewMonthGrid],
            events: this.calendarEvents,
        });

        this.calendarCampain = createCalendar({
            isDark: true,
            views: [viewMonthGrid],
            events: this.calendarCampainEvents,
        });

        this.calendar.render(this.$refs.calendarRef)
        this.calendarCampain.render(this.$refs.calendarCampainRef)
    },
    components: {
        UserLayout,
        Link
    }
}
</script>

<template>
        <div class="container mx-auto flex flex-col md:flex-row gap-4 h-full sm:h-screen">
            <div class="flex flex-col flex-3 h-full w-full rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 gap-5 px-4 py-4">
                <div class="flex flex-col gap-2 ">
                    <div class="flex justify-center gap-4">
                        <Link class="bg-blue-800 py-2 rounded-xl w-full text-sm text-center" :href="route('posts.create')">Create Post</Link>
                        <Link class="bg-blue-800 py-2 rounded-xl w-full text-sm text-center" :href="route('posts.list')">Edit Posts</Link>
                        <Link class="bg-blue-800 py-2 rounded-xl w-full text-sm text-center" :href="route('posts.list')">Delete Posts</Link>
                    </div>
                </div>
                <div id="calendarCampain" ref="calendarCampainRef" />
            </div>

            <div class="flex flex-col flex-3 h-full w-full rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 gap-5 px-4 py-4">
                <div class="flex flex-col gap-2 ">
                    <div class="flex justify-center gap-4">
                        <Link class="bg-blue-800 py-2 rounded-xl w-full text-sm text-center" :href="route('campains.create')">Create Campain</Link>
                        <Link class="bg-blue-800 py-2 rounded-xl w-full text-sm text-center" :href="route('campains.list')">Edit Campains</Link>
                        <Link class="bg-blue-800 py-2 rounded-xl w-full text-sm text-center" :href="route('campains.list')">Delete Campains</Link>
                    </div>
                </div>
                <div id="calendar" ref="calendarRef" />
            </div>
        </div>
</template>


<!-- <a class="bg-blue-800 py-2 rounded-xl text-sm text-center">Browse Gallery</a> -->
<!-- <a class="bg-blue-800 py-2 rounded-xl text-sm text-center" href="#">Upload Photos</a> -->
<!-- <a class="bg-blue-800 py-2 rounded-xl text-sm text-center" href="#">Delete Photos</a> -->
