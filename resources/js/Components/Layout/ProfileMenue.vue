<template>

<Dropdown align="right" width="48">
                    <template #trigger>
                        <button v-if="page.props.jetstream.managesProfilePhotos"
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" :src="page.props.auth.user.profile_photo_url"
                                :alt="page.props.auth.user.name">
                        </button>

                        <span v-else class="inline-flex rounded-md">
                            <button type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-gray-800 hover:text-gray-400 focus:outline-none focus:bg-gray-900 active:bg-gray-900 transition ease-in-out duration-150">
                                {{ page.props.auth.user.name }}

                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <div v-if="page.props.auth.user.role == 'ADMIN'">
                            <div class="block px-4 py-2 text-xs text-white">
                                Admin Management
                            </div>

                            <DropdownLink :href="route('admin.dashboard')">
                                Admin Panel
                            </DropdownLink>
                        </div>


                        <div class="block px-4 py-2 text-xs text-white">
                            Manage Account
                        </div>

                        <DropdownLink :href="route('profile.show')">
                            Profile
                        </DropdownLink>

                        <DropdownLink :href="route('spark.portal')">
                            Subscriptions
                        </DropdownLink>

                        <DropdownLink v-if="page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                            API Tokens
                        </DropdownLink>


                        <!-- Authentication -->
                        <form @submit.prevent="logout">
                            <DropdownLink as="button" class="text-white">
                                Log Out
                            </DropdownLink>
                        </form>
                    </template>
                </Dropdown>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const page = usePage();

const logout = () => {
    router.post(route('logout'));
}


</script>

<style lang="scss" scoped>

</style>