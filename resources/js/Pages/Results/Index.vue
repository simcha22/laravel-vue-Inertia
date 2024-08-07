<template>
    <Head :title="exercise[0].name"/>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ exercise[0].name }}</h2>
                <button @click="showAddResults = true"
                        class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2">
                    Add
                </button>
            </div>
        </template>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" text-gray-900 dark:text-gray-100">
                <div class="grid gap-4 lg:gap-8 md:grid-cols-3 py-8">
                    <StatisticsCard v-for="card in cards" :card="card"/>
                </div>
            </div>
            <div class=" bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    level
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    rounds
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    weights
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    percentage
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    rehearsals
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    done at
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="result in exercise[0].results"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ result.reps_type }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ result.level }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ result.rounds }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ result.weights_text }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ result.percentage_text }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ result.rehearsals_text }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ formatMessageDateLong(result.done_at) }}
                                </td>
                                <td class="px-6 py-4 text-right flex">
                                    <!--                                    <Link v-if="can('user.update')" :href="route('users.edit', user.id)" as="button"-->
                                    <!--                                          class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">-->
                                    <!--                                        Edit-->
                                    <!--                                    </Link>-->
                                    <button type="button"
                                            @click="confirmingDeleteResult(result.id)"
                                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <PsrModal :show="showAddResults" @close="closeModal" :exercise="exercise"/>

        <Modal :show="confirmingResultDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete this log?
                </h2>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel</SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        @click="deleteResult"
                    >
                        Delete
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link, router} from "@inertiajs/vue3";
import {ref} from "vue";
import PsrModal from "@/Pages/Results/Components/PsrModal.vue";
import StatisticsCard from "@/Pages/Results/Components/StatisticsCard.vue";
import useTime from "@/Composteble/time.js";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

const {formatMessageDateLong} = useTime()
const props = defineProps(['exercise', 'cards'])
const showAddResults = ref(false)
const resultToDelete = ref(null)
const confirmingResultDeletion = ref(false)

const confirmingDeleteResult = (id) => {
    resultToDelete.value = id
    confirmingResultDeletion.value = true
}

const deleteResult = () => {
    router.delete(route('results.destroy', {exercise: props.exercise[0].id, result: resultToDelete.value}))
    closeModal()
}

const closeModal = () => {
    confirmingResultDeletion.value = false
    showAddResults.value = false
}

</script>
