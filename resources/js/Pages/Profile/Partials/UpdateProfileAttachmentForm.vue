<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import AttachmentItemView from "@/Pages/Posts/Components/AttachmentItemView.vue";
import {ref} from "vue";

const chosenFiles = ref([]);

const form = useForm({
    files: [],
});

const onFileChange = (ev) =>{
    const files = ev.target.files;
    const uploadFiles = [...files].map((file) => {
        return {
            file: file,
            url: URL.createObjectURL(file),
            delete: true
        }
    })

    chosenFiles.value = [...chosenFiles.value, ...uploadFiles];
    ev.target.value = null
}

const savePost = () =>{
    chosenFiles.value.map((item) => {form.files.push(item.file)})
    form.post(route('profile.update.attachment'))
}

const removeFile = (url) =>{
    chosenFiles.value = chosenFiles.value.filter(item => item.url !== url)
}

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profile Attachments</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Upload your attachment's profile.
            </p>
        </header>

        <form @submit.prevent="savePost" class="mt-6 space-y-6">

            <div>
                <InputLabel value="Attachments" />

                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" multiple @change="onFileChange"/>
                    </label>
                </div>

                <InputError class="mt-2" :message="form.errors.files" />
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <AttachmentItemView v-for="file in chosenFiles" :file="file" @remove="removeFile"/>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Upload</PrimaryButton>

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
    </section>
</template>
