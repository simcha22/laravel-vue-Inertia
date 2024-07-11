<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import useTime from "@/Composteble/time.js";
import CommentItem from "@/Pages/Posts/Components/CommentItem.vue";
import CreateComment from "@/Pages/Posts/Components/CreateComment.vue";
import AttachmentItemView from "@/Pages/Posts/Components/AttachmentItemView.vue";

const props = defineProps(['post'])
const {formatMessageDateLong} = useTime()

</script>

<template>
    <Head :title=" post.title"/>
    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div>
                            <Link :href="route('posts.edit', post.id)" as="button"
                                  class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                Edit
                            </Link>
                        </div>
                        <div
                            class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                            <div class="p-4 md:p-5">
                                <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                                    {{ post.title }}
                                </h3>
                                <p class="mt-2 text-gray-500 dark:text-neutral-400">
                                    {{ post.body }}
                                </p>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                                    <AttachmentItemView v-for="file in post.attachments" :file="file" />
                                </div>

                                <div class="flex items-center gap-4 mt-6">
                                    <img class="w-10 h-10 rounded-full" src="@/assets/Images/avatar.jpeg" alt="">

                                    <div class="font-medium dark:text-white">
                                        <div><small>Created by:</small> {{ post.user_name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-gray-100 border-t rounded-b-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
                                <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                                    Created: {{ formatMessageDateLong(post.created_at) }}, Last Update:
                                    {{ formatMessageDateLong(post.updated_at) }}
                                </p>
                            </div>
                        </div>
                        <div
                            class="flex flex-col bg-white mt-4 p-4 border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                            <CreateComment :post="post.id"/>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">
                                Comments
                            </h3>
                            <CommentItem v-for="comment in post.comments" :comment="comment"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
