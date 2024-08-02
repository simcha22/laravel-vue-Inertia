<template>
    <Modal :show="show" @close="closeModal" side="center">
        <div class="p-6">
            <form @submit.prevent="savePost" class="space-y-6">
                <div>
                    <RadioInput v-model="form.type" :items="['constant','variable']" name="type"/>
                </div>
                <div class="flex justify-center">
                    <div class="mr-2  w-1/2 text-center">
                        <InputLabel for="sets" value="Sets"/>
                        <InputNumber id="sets" v-model="form.sets"/>
                    </div>
                    <div class="mr-2 w-1/2 text-center" v-if="form.type === 'constant'">
                        <InputLabel for="reps" value="Reps"/>
                        <InputNumber id="reps" v-model="form.reps"/>
                    </div>
                </div>
                <div>
                    <InputLabel for="weight" value="Weight"/>
                    <div v-for="weight in form.weight" class="flex mb-3">
                        <InputGroup :number="weight.number" :reps="weight.reps"/>
                        <InputNumber v-if="form.type === 'variable'" id="reps" v-model="weight.reps" value="reps"/>
                        <InputNumber id="percent" v-model="weight.percent" value="%" max="100" min="50"/>
                        <!--<TextInput v-model="weight.percent" placeholder="percent"/> -->
                    </div>
                </div>
                <div>
                    <RadioInput v-model="form.level" :items="['rx','scaled']" name="level"/>
                </div>
                <div>
                    <InputLabel for="notes" value="Notes"/>

                    <textarea
                        id="notes"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        v-model="form.notes"
                        required
                        autocomplete="notes"
                    ></textarea>

                    <InputError class="mt-2" :message="form.errors.notes"/>
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
<script setup>
import Modal from "@/Components/Modal.vue";
import InputNumber from "@/Components/App/InputNumber.vue";
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import RadioInput from "@/Components/App/RadioInput.vue";
import InputGroup from "@/Components/App/InputGroup.vue";
import {onMounted, watch} from "vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import SaveButton from "@/Components/SaveButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps(['show', 'exercise'])
const emit = defineEmits(['close'])

const form = useForm({
    sets: 5,
    reps: 5,
    type: 'constant', // 'constant','variable'
    level: 'rx',
    weight: [],
    notes: '',
    done_at: '',
    exercise_id: props.exercise.id
})
const closeModal = () => {
    emit('close')
}
onMounted(() => {
    changeSets(5)
})
const savePost = () => {

}

watch(() => form.type, (newValue, oldValue) => {
    changeSets(form.sets)
});

watch(() => form.sets, (newValue, oldValue) => {
    changeSets(newValue)
});

watch(() =>form.reps, (newValue, oldValue) => {
    if (form.type === 'constant') {
        form.weight.map(item => item.reps = newValue)
    }
})
const changeSets = (value) => {
    if (form.type === 'constant') {
        form.weight = []; // Clear previous objects
        for (let i = 0; i < value; i++) {
            form.weight.push({
                number: `${i + 1}`,
                reps: `${form.reps}`,
                value: '',
                percent: '',
            });
        }
    } else if (form.type === 'variable') {
        form.weight = []; // Clear previous objects
        for (let i = 0; i < value; i++) {
            form.weight.push({
                number: `${i + 1}`,
                reps: ``,
                value: '',
                percent: '',
            });
        }
    }
}
</script>
