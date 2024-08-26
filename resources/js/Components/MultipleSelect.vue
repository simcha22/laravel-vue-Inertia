<template>
    <div class="mt-2">
        <div
            class="w-full justify-between text-gray-800 focus:ring-4 border focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-blue-800 dark:text-gray-300">
            <div class="text-start">
                <span v-for="item in items" v-show="selectedOptions.includes(item.id)"
                    class="inline-flex items-center px-2 py-1 me-2 mb-2 text-sm font-medium text-indigo-800 bg-indigo-100 rounded dark:bg-indigo-900 dark:text-indigo-300">
                    {{item.name}}
                    <button type="button" @click="selectItem(item.id)"
                            class="inline-flex items-center p-1 ms-2 text-sm text-indigo-400 bg-transparent rounded-sm hover:bg-indigo-200 hover:text-indigo-900 dark:hover:bg-indigo-800 dark:hover:text-indigo-300">
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        <span class="sr-only">Remove badge</span>
                    </button>
                    </span>
            </div>
            <button type="button">
                <svg @click="showItems = !showItems" class="w-2.5 h-2.5 ms-3 cursor-pointer" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 4 4 4-4"/>
                </svg>
            </button>
        </div>
        <div v-show="showItems"
             class="z-10 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-full dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                <li v-for="item in items">
                    <a @click="selectItem(item.id)" v-show="!selectedOptions.includes(item.id)"
                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{item.name}}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import {ref} from "vue";

const props = defineProps(['placeholder', 'items', 'selectedOptions'])
const emit = defineEmits(['update'])
const showItems = ref(false)

const selectItem = (id) => {
    emit('update', id)
}
</script>

<style>

</style>

