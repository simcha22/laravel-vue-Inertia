<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link, router} from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {ref} from "vue";
import useTime from "@/Composteble/time.js";
import WorkoutItem from "@/Pages/Workouts/Components/WorkoutItem.vue";

const props = defineProps(['workouts'])
const confirmingPostDeletion = ref(false)
const postToDelete = ref(null)

const {formatMessageDateLong} = useTime()
// const deletePost = () => {
//     router.delete(route('posts.destroy', postToDelete.value))
//     closeModal()
// }
//
// const confirmingDeletePost = (id) => {
//     postToDelete.value = id
//     confirmingPostDeletion.value = true
// }
//
// const closeModal =() =>{
//     confirmingPostDeletion.value = false
// }
</script>

<template>
    <Head title="Workout"/>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Workouts</h2>
                <Link :href="route('workouts.create')"
                      class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2">
                    Create new Workout
                </Link>
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
    </AuthenticatedLayout>
</template>
