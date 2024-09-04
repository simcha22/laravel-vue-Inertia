<template>
    <Head :title="workout.name"/>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div
                            class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                            <div class="p-4 md:p-5">
                                <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                                    {{ workout.name }}
                                </h3>
                                <p class="mt-2 text-gray-500 dark:text-neutral-400">
                                    {{ workout.content }}
                                </p>
                               <p class="mt-2 text-gray-500 dark:text-neutral-400">
                                    Time Camp: {{ workout.time }}
                                </p>
                                <div class="mt-2">
                                <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{workout.score_type}}</span>
                                </div>

                                <div class="mt-2">
                                    <p class="mt-2 text-gray-500 dark:text-neutral-400">Exercises:</p>
                                    <span v-for="exercise in workout.exercises" @click="showExercise(exercise)" class="cursor-pointer bg-indigo-100 text-indigo-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">{{exercise.name}}</span>
                                </div>

                                <div class="mt-4">
                                    <button
                                          class="inline-flex items-center mr-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-emerald-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">Set Your results
                                        <svg class="w-3 h-3 ms-2 rtl:rotate-180 lucide lucide-biceps-flexed"
                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M12.409 13.017A5 5 0 0 1 22 15c0 3.866-4 7-9 7-4.077 0-8.153-.82-10.371-2.462-.426-.316-.631-.832-.62-1.362C2.118 12.723 2.627 2 10 2a3 3 0 0 1 3 3 2 2 0 0 1-2 2c-1.105 0-1.64-.444-2-1"/>
                                            <path d="M15 14a5 5 0 0 0-7.584 2"/>
                                            <path d="M9.964 6.825C8.019 7.977 9.5 13 8 15"/>
                                        </svg>
                                    </button>
                                    <button
                                        @click="showResultsModal = true"
                                        class="inline-flex items-center mr-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-emerald-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">Show Results

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 ms-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                        </svg>

                                    </button>
                                    <button
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-emerald-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">Edit
                                    </button>
                                </div>


                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                                    <AttachmentItemView v-for="file in workout.attachments" :file="file" />
                                </div>

                                <div class="flex items-center gap-4 mt-6">
                                    <img class="w-10 h-10 rounded-full" src="@/assets/Images/avatar.jpeg" alt="">

                                    <div class="font-medium dark:text-white">
                                        <div><small>Created by:</small> {{ workout.user.name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-gray-100 border-t rounded-b-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
                                <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                                    Created: {{ formatMessageDateLong(workout.created_at) }}, Last Update:
                                    {{ formatMessageDateLong(workout.updated_at) }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <ShowModal :show="showExerciseView" @close="closeModal" :exercise="selectedExercise"/>
        <ResultsModal :show="showResultsModal" @close="closeModal" :results="workout.userWorkouts"/>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AttachmentItemView from "@/Pages/Posts/Components/AttachmentItemView.vue";
import useTime from "@/Composteble/time.js";
import {Head, Link} from "@inertiajs/vue3";
import ShowModal from "@/Pages/Exercises/Components/ShowModal.vue";
import {ref} from "vue";
import ResultsModal from "@/Pages/Workouts/Components/ResultsModal.vue";

const props = defineProps(['workout'])
const showExerciseView = ref(false)
const selectedExercise = ref({})
const showResultsModal = ref(false)

const {formatMessageDateLong} = useTime()

const showExercise = (exercise) =>{
    selectedExercise.value = exercise
    showExerciseView.value = true
}

const closeModal = () => {
    showExerciseView.value = false
    selectedExercise.value = {}

    showResultsModal.value = false
}
</script>
