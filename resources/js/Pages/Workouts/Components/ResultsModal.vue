<template>
    <Modal :show="show" @close="emit('close')">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Results
            </h2>

            <div class="mt-4">

                <div>
                    <RadioInput v-model="level" :items="['rx','scaled']" name="level"/>
                </div>

                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:pb-4" v-for="result in results">
                        <div class="flex items-center space-x-4 rtl:space-x-reverse">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full" src="@/assets/Images/avatar.jpeg" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Neil Sims
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    email@flowbite.com
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                10:00
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </Modal>
</template>
<script setup>
import Modal from "@/Components/Modal.vue";
import RadioInput from "@/Components/App/RadioInput.vue";
import {ref} from "vue";

const props = defineProps(['show', 'results'])
const emit = defineEmits(['close'])

const level = ref('rx')
</script>
