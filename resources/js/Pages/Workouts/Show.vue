<template>
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

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                                    <AttachmentItemView v-for="file in workout.attachments" :file="file" />
                                </div>

                                <div class="flex items-center gap-4 mt-6">
                                    <img class="w-10 h-10 rounded-full" src="@/assets/Images/avatar.jpeg" alt="">

                                    <div class="font-medium dark:text-white">
                                        <div><small>Created by:</small> {{ workout.user_name }}</div>
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

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AttachmentItemView from "@/Pages/Posts/Components/AttachmentItemView.vue";
import useTime from "@/Composteble/time.js";


const props = defineProps(['workout'])
const {formatMessageDateLong} = useTime()
</script>
