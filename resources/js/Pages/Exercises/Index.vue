<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {ref} from "vue";
import CreateModal from "@/Pages/Exercises/Components/CreateModal.vue";
import CategoryItem from "@/Pages/Exercises/Components/CategoryItem.vue";
import ShowModal from "@/Pages/Exercises/Components/ShowModal.vue";
import EditModal from "@/Pages/Exercises/Components/EditModal.vue";

const props = defineProps(['categorise'])
const showCreateExercise = ref(false)
const showExerciseView = ref(false)
const selectedExercise = ref({})
const showExerciseEdit = ref(false)

const closeModal = () => {
    showCreateExercise.value = false
    showExerciseView.value = false
    showExerciseEdit.value = false
    selectedExercise.value = {}
}

const showExercise = (exercise) =>{
    selectedExercise.value = exercise
    showExerciseView.value = true
}

const showEdit = (exercise) => {
    showExerciseEdit.value = true
    selectedExercise.value = exercise
}

</script>

<template>
    <Head title="Exercises"/>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Exercises</h2>
                <button @click="showCreateExercise = true"
                        class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2">
                    Create new Exercise
                </button>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <ol class="relative border-s border-emerald-200 dark:border-gray-700">
                            <CategoryItem v-for="category in categorise" :category="category" @clickOnShow="showExercise" @clickOnEdit="showEdit"/>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <CreateModal :show="showCreateExercise" @close="closeModal" :categorise="categorise"/>
        <EditModal :show="showExerciseEdit" :exercise="selectedExercise" :categorise="categorise" @close="closeModal"/>
        <ShowModal :show="showExerciseView" @close="closeModal" :exercise="selectedExercise"/>
    </AuthenticatedLayout>
</template>
