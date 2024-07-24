<script setup>
const props = defineProps(['category'])
</script>

<template>
    <li class="mb-8 ms-4">
        <div
            class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
        <div class="mb-1 text-lg font-normal leading-none text-emerald-500 dark:text-gray-500">
            {{ category.name }}
        </div>
        <div v-for="exercise in category.exercises" class="mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ exercise.name }}</h3>
            <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ exercise.details }}</p>
            <div class="mb-4">
                <a href="#"
                   class="inline-flex items-center mr-2 px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-emerald-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">Your
                    personal PRs
                    <svg class="w-3 h-3 ms-2 rtl:rotate-180 lucide lucide-biceps-flexed"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M12.409 13.017A5 5 0 0 1 22 15c0 3.866-4 7-9 7-4.077 0-8.153-.82-10.371-2.462-.426-.316-.631-.832-.62-1.362C2.118 12.723 2.627 2 10 2a3 3 0 0 1 3 3 2 2 0 0 1-2 2c-1.105 0-1.64-.444-2-1"/>
                        <path d="M15 14a5 5 0 0 0-7.584 2"/>
                        <path d="M9.964 6.825C8.019 7.977 9.5 13 8 15"/>
                    </svg>
                </a>
                <a href="#"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-emerald-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">Learn
                    more
                    <svg class="w-3 h-3 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
            <hr>
        </div>
    </li>
</template>
