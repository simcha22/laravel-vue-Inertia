<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {ref} from "vue";
import WorkoutItem from "@/Pages/Workouts/Components/WorkoutItem.vue";
import CreateModal from "@/Pages/Workouts/Components/CreateModal.vue";

const props = defineProps(['workouts', 'exercises'])
const showCreateWorkout = ref(false)

const closeModal =() =>{
    showCreateWorkout.value = false
}
</script>

<template>
    <Head title="Workout"/>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Workouts</h2>
                <button @click="showCreateWorkout = true"
                      class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2">
                    Create new Workout
                </button>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="relative overflow-x-auto">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <WorkoutItem v-for="workout in workouts" :workout="workout"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <CreateModal :show="showCreateWorkout" @close="closeModal" :exercises="exercises"/>
    </AuthenticatedLayout>
</template>
