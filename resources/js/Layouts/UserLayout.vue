<script setup>
import { ref } from 'vue';

import Banner from '@/Components/Banner.vue';
import Toast from 'primevue/toast';

import TopBar from '@/Components/Layout/TopBar.vue';
import Sidebar from '@/Components/Layout/Sidebar/Sidebar.vue';
import AnimatedBubbles from '@/Components/Layout/AnimatedBubbles.vue';

const sideBarState = ref(false);
const chanegState = () => {
    sideBarState.value = !sideBarState.value;
};

</script>

<template>
    <Banner />

    <body class="body bg-black min-h-screen h-auto">
        <TopBar :sideBarState="sideBarState" />
        <Sidebar :state="sideBarState" @toggle-sidebar="chanegState()" />
        <AnimatedBubbles />

        <div class="content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4 h-full" :class="{
            'ml-12': !sideBarState,
            'md:ml-60': sideBarState
        }">
            <div class="px-5 py-3 text-white rounded-lg w-full h-full">
                <slot />
            </div>
        </div>

        <Toast position="bottom-right" />
    </body>
</template>


<script>
export default {
    data() {
        return {
            userTeamTreasholdReached: Boolean || true,
            sidebar: null,
            maxSidebar: null,
            miniSidebar: null,
            roundout: null,
            maxToolbar: null,
            logo: null,
            content: null,
            moon: null,
            sun: null,
            app_name: import.meta.env.VITE_APP_NAME,
            image: null
        }
    },

    mounted() {
        this.userTeamTreasholdReached = this.$page.props.userTeamTreasholdReached;
        this.sidebar = document.querySelector("aside");
        this.maxSidebar = document.querySelector(".max");
        this.miniSidebar = document.querySelector(".mini");
        this.roundout = document.querySelector(".roundout");
        this.maxToolbar = document.querySelector(".max-toolbar");
        this.logo = document.querySelector('.logo');
        this.content = document.querySelector('.content');
        this.moon = document.querySelector(".moon");
        this.sun = document.querySelector(".sun");
        this.image = 'https://ui-avatars.com/api/?name=' + this.$page.props.auth.user.name
    },

    methods: {

        setDark(val) {
            if (val === "dark") {
                document.documentElement.classList.add('dark')
                this.moon.classList.add("hidden")
                this.sun.classList.remove("hidden")
            } else {
                document.documentElement.classList.remove('dark')
                this.sun.classList.add("hidden")
                this.moon.classList.remove("hidden")
            }
        },

        openNav() {
            if (this.sidebar.classList.contains('-translate-x-48')) {
                this.sidebar.classList.remove("-translate-x-48")
                this.sidebar.classList.add("translate-x-none")
                this.maxSidebar.classList.remove("hidden")
                this.maxSidebar.classList.add("flex")
                this.miniSidebar.classList.remove("flex")
                this.miniSidebar.classList.add("hidden")
                this.maxToolbar.classList.add("translate-x-0")
                this.maxToolbar.classList.remove("translate-x-24", "scale-x-0")
                this.logo.classList.remove("ml-12")
            } else {
                this.sidebar.classList.add("-translate-x-48")
                this.sidebar.classList.remove("translate-x-none")
                this.maxSidebar.classList.add("hidden")
                this.maxSidebar.classList.remove("flex")
                this.miniSidebar.classList.add("flex")
                this.miniSidebar.classList.remove("hidden")
                this.maxToolbar.classList.add("translate-x-24", "scale-x-0")
                this.maxToolbar.classList.remove("translate-x-0")
                this.logo.classList.add('ml-12')
            }
        }
    },
}
</script>

<style>
body {
    margin: 0 !important;
    padding: 0 !important;
}
</style>
