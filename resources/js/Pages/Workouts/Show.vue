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

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AttachmentItemView from "@/Pages/Posts/Components/AttachmentItemView.vue";
import useTime from "@/Composteble/time.js";
import {Head} from "@inertiajs/vue3";
import ShowModal from "@/Pages/Exercises/Components/ShowModal.vue";
import {ref} from "vue";

const props = defineProps(['workout'])
const showExerciseView = ref(false)
const selectedExercise = ref({})

const {formatMessageDateLong} = useTime()

const showExercise = (exercise) =>{
    selectedExercise.value = exercise
    showExerciseView.value = true
}

const closeModal = () => {
    showExerciseView.value = false
    selectedExercise.value = {}
}
</script>
