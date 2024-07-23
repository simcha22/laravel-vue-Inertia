<template>
    <Head title="Create Workout" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Workout</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <form @submit.prevent="savePost" class="space-y-6">

                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>


                            <div>
                                <InputLabel for="content" value="Content" />

                                <textarea
                                    id="content"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    v-model="form.content"
                                    required
                                    autocomplete="content"
                                ></textarea>

                                <InputError class="mt-2" :message="form.errors.content" />
                            </div>

                            <div>
                                <InputLabel for="done_at" value="Done at" />

                                <TextInput
                                    id="done_at"
                                    type="datetime-local"
                                    class="mt-1 block w-full"
                                    v-model="form.done_at"
                                    required
                                    autofocus
                                    autocomplete="done_at"
                                />

                                <InputError class="mt-2" :message="form.errors.done_at" />
                            </div>

                            <div>
                                <InputLabel for="score" value="Score" />

                                <textarea
                                    id="score"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    v-model="form.score"
                                    required
                                    autocomplete="score"
                                ></textarea>

                                <InputError class="mt-2" :message="form.errors.score" />
                            </div>

                            <div class="flex items-center gap-4">
                                <SaveButton :disabled="form.processing">Save</SaveButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                                </Transition>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup >
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SaveButton from "@/Components/SaveButton.vue";

const form = useForm({
    name : '',
    content: '',
    done_at: '',
    score: '',
});

const savePost = () =>{
    form.post(route('workouts.store'))
}

</script>
