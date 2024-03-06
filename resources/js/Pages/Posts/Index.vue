<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import { createCalendar, viewMonthGrid } from '@schedule-x/calendar'
import '@schedule-x/theme-default/dist/index.css'
import { ref } from 'vue'
</script>

<template>
    <UserLayout>
        <div class="container mx-auto flex flex-col md:flex-row gap-4 h-[90vh] ">
            <div
                class=" flex flex-col flex-1 h-full w-full border bg-white border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 gap-5 px-4 py-4">
                <div class="flex flex-col gap-2 flex-1">
                    <button class="bg-blue-800 py-2 rounded-xl h-5">Create Post</button>
                    <button class="bg-blue-800 py-2 rounded-xl h-5">Create Campain</button>
                    <button class="bg-blue-800 py-2 rounded-xl h-5">Browse Gallery</button>

                    <button class="bg-blue-800 py-2 rounded-xl mt-5 h-5">Edit Post</button>
                    <button class="bg-blue-800 py-2 rounded-xl h-5">Edit Campain</button>
                    <button class="bg-blue-800 py-2 rounded-xl h-5">Upload Photos</button>

                    <button class="bg-blue-800 py-2 rounded-xl mt-5 h-5">Delete Post</button>
                    <button class="bg-blue-800 py-2 rounded-xl h-5">Delete Campain</button>
                    <button class="bg-blue-800 py-2 rounded-xl h-5">Delete Photos</button>
                </div>
                <div id="calendarCampain" ref="calendarCampainRef" class="h-full w-full flex-2 " />
            </div>
            <div id="calendar" ref="calendarRef" class="h-full w-full flex-1" />
        </div>
    </UserLayout>
</template>

<script>
export default {
    props: {
        posts: Array,
        campaigns: Array,
    },
    data: () => ({
        calendar: null,
        calendarCampain: null,
        calendarEvents: [],
        calendarCampainEvents: [],
    }),
    setup() {
        return {
            calendarRef,
            calendarCampainRef
        }
    },
    mounted() {         
        this.calendarEvents = this.posts.map((post) => {
            return {
                id: post.id,
                title: post.title,
                description: post.description,
                start: post.publish_date,
                end: post.publish_date,
            }
        }); 

        this.calendarCampainEvents = this.campaigns.map((campain) => {
            return {
                id: campain.id,
                title: campain.name,
                description: campain.description,
                start: campain.start,
                end: campain.end,
            }
        }); 
        
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
}
</script>
