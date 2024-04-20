<template>
    <Dropdown v-if="userTeamTreasholdReached != true || page.props.auth.user.current_team" align="right" width="60">
        <template #trigger>
            <span class="inline-flex rounded-md">
                <button type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-gray-800 hover:text-gray-400 focus:outline-none focus:bg-gray-900 active:bg-gray-900 transition ease-in-out duration-150">
                    {{ page.props.auth.user.current_team ? page.props.auth.user.current_team.name : 'No selected' }}

                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                    </svg>
                </button>
            </span>
        </template>
        <template #content>
            <div class="w-60">
                <!-- Team Settings -->
                <DropdownLink :href="route('teams.create')">
                    {{ userTeamTreasholdReached != true ? 'Create Company' : 'Upgrade Plan' }}
                </DropdownLink>

                <DropdownLink v-if="page.props.auth.user.current_team"
                    :href="route('teams.show', page.props.auth.user.current_team)">
                    Company Settings
                </DropdownLink>
                <!-- Team Switcher -->
                <template v-if="page.props.auth.user.all_teams.length > 0">
                    <div class="border-t border-gray-600" />

                    <div class="block px-4 py-2 text-xs text-white">
                        Switch Company
                    </div>

                    <template v-for="team in page.props.auth.user.all_teams" :key="team.id">
                        <form @submit.prevent="switchToTeam(team)">
                            <DropdownLink as="button">
                                <div class="flex items-center text-gray-400">
                                    <svg v-if="team.id == page.props.auth.user.current_team_id"
                                        class="me-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                    <div>{{ team.name }}</div>
                                </div>
                            </DropdownLink>
                        </form>
                    </template>
                </template>
            </div>
        </template>
    </Dropdown>
</template>

<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const page = usePage();

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
}


</script>

<style lang="scss" scoped></style>