<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import WorkoutList from "@/Components/App/WorkoutList.vue";
import WorkoutCalendar from "@/Components/App/WorkoutCalendar.vue";
</script>

<template>
    <Head title="Calendar"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Calendar</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="text-gray-900 dark:text-gray-100">
                        <h2 class="mt-4 ml-4">Upcoming Workouts</h2>
                        <div class="p-6 flex justify-between">
                            <div class="w-1/2">
                                <WorkoutList/>
                            </div>
                            <div class="w-1/2">
                                <WorkoutCalendar/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
