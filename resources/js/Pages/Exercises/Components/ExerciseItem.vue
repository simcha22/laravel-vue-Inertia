<template>
    <Link class="flex flex-col group bg-white border shadow-sm rounded-xl overflow-hidden hover:shadow-lg transition dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70"
       :href="route('exercises.show', exercise.id)">
        <div class="relative pt-[50%] sm:pt-[60%] lg:pt-[80%] rounded-t-xl overflow-hidden">
            <img
                class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-t-xl"
                src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2532&q=80"
                alt="Image Description">
        </div>
        <div class="p-4 md:p-5">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                {{exercise.name}}
            </h3>
            <p class="mt-1 text-gray-500 dark:text-neutral-400">
                {{exercise.details}}
            </p>
        </div>
    </Link>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps(['exercise'])
</script>
