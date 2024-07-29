<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SaveButton from "@/Components/SaveButton.vue";
import {useForm} from "@inertiajs/vue3";
import Select from "@/Components/Select.vue";
import {defineProps, defineEmits, watch} from "vue";

const props = defineProps(['show', 'exercise', 'categorise'])
const emit = defineEmits(['close'])

const form = useForm({
    name: '',
    details: '',
    highlights: '',
    link: '',
    category_id: ''
});

const savePost = () => {
    form.put(route('exercises.update', props.exercise.id))
    closeModal()
}

const closeModal = () => {
    form.reset()
    emit('close')
}

watch(props, (value) => {
    if(props.exercise){
        form.name = props.exercise.name
        form.details = props.exercise.details
        form.highlights = props.exercise.highlights
        form.link = props.exercise.link
        form.category_id = props.exercise?.category?.id
    }
})

</script>

<template>
    <Modal :show="show" @close="closeModal" side="right">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Create Exercise
            </h2>

            <form @submit.prevent="savePost" class="space-y-6">

                <div>
                    <InputLabel for="name" value="Name"/>

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name"/>
                </div>

                <div>
                    <InputLabel for="category" value="Category"/>

                    <Select class="mt-1 block w-full" id="category" name="category" v-model="form.category_id"
                            :items="categorise"/>

                    <InputError class="mt-2" :message="form.errors.category_id"/>
                </div>

                <div>
                    <InputLabel for="details" value="Details"/>

                    <textarea
                        id="details"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        v-model="form.details"
                        required
                        autocomplete="details"
                    ></textarea>

                    <InputError class="mt-2" :message="form.errors.details"/>
                </div>

                <div>
                    <InputLabel for="highlights" value="Highlights"/>

                    <textarea
                        id="highlights"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        v-model="form.highlights"
                        required
                        autocomplete="highlights"
                    ></textarea>

                    <InputError class="mt-2" :message="form.errors.highlights"/>
                </div>

                <div>
                    <InputLabel for="link" value="Link"/>

                    <TextInput
                        id="link"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.link"
                        required
                        autofocus
                        autocomplete="link"
                    />

                    <InputError class="mt-2" :message="form.errors.link"/>
                </div>

                <div class="mt-6 flex justify-end">

                    <SaveButton :disabled="form.processing">Save</SaveButton>

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                    </Transition>

                    <SecondaryButton @click="closeModal"> Cancel</SecondaryButton>
                </div>
            </form>
        </div>
    </Modal>

</template>
