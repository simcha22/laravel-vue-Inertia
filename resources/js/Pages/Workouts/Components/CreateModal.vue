<template>
    <Modal :show="show" @close="emit('close')" side="right">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Create Workout
            </h2>

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

                <div>
                    <InputLabel for="score_type" value="Score type" />
                    <RadioInput v-model="form.score_type" :items="['time','reps']" name="score_type"/>
                </div>

                <div>
                    <InputLabel for="time" value="Time camp" />

                    <TextInput
                        id="time"
                        type="time"
                        class="mt-1 block w-full"
                        v-model="form.time"
                        required
                        autofocus
                        autocomplete="time"
                    />

                    <InputError class="mt-2" :message="form.errors.time" />
                </div>

                <div>
                    <InputLabel for="exercises" value="Exercises" />

                    <MultipleSelect class="mt-1 block w-full" :selectedOptions="form.exercises" @update="UpdateExercises" :items="exercises" placeholder="Select Exercise"/>

                    <InputError class="mt-2" :message="form.errors.exercises" />
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

                    <SecondaryButton @click="emit('close')"> Cancel </SecondaryButton>
                </div>

            </form>
        </div>
    </Modal>

</template>
<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SaveButton from "@/Components/SaveButton.vue";
import {useForm} from "@inertiajs/vue3";
import RadioInput from "@/Components/App/RadioInput.vue";
import MultipleSelect from "@/Components/MultipleSelect.vue";

const props = defineProps(['show', 'exercises'])
const emit = defineEmits(['close'])

const form = useForm({
    name : '',
    content: '',
    done_at: '',
    score: '',
    time: '',
    score_type: 'time',
    exercises: []
});

const UpdateExercises = (id) => {
    if(form.exercises.includes(id)){
        form.exercises = form.exercises.filter(num => num !== id);
    }else{
        form.exercises.push(id)
    }
}

const savePost = () =>{
    form.post(route('workouts.store'))
    emit('close')
}

</script>
