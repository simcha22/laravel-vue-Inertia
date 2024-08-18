<template>
    <Modal :show="show" @close="closeModal" side="center">
        <div class="p-6">

            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ exercise[0].name }}</h2>
            </div>
            <form @submit.prevent="savePost" class="space-y-6 mt-4">
                <div>
                    <RadioInput v-model="form.type" :items="['constant','variable']" name="type"/>
                </div>
                <div class="flex justify-center">
                    <div class="mr-2  w-1/2 text-center">
                        <InputLabel for="sets" value="Sets"/>
                        <InputNumber id="sets" v-model="form.sets" minValue="5" maxValue="10" stepValue="1"/>
                    </div>
                    <div class="mr-2 w-1/2 text-center" v-if="form.type === 'constant'">
                        <InputLabel for="reps" value="Reps"/>
                        <InputNumber id="reps" v-model="form.reps" minValue="1" maxValue="20" stepValue="1"/>
                    </div>
                </div>
                <div>
                    <InputLabel for="weight" value="Weight"/>
                    <div v-for="weight in form.weight" class="flex mb-3">
                        <InputGroup v-model="weight.value" :number="weight.number"
                                    :reps="form.type === 'constant' ? weight.reps + ' reps' : ''"/>
                        <InputNumber v-if="form.type === 'variable'" id="reps" v-model="weight.reps" minValue="1"
                                     maxValue="20" value="reps" stepValue="1"/>
                        <InputNumber id="percent" v-model="weight.percent" value="%" minValue="50" maxValue="105"
                                     stepValue="5"/>
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
                        autocomplete="notes"
                    ></textarea>

                    <InputError class="mt-2" :message="form.errors.notes"/>
                </div>

                <div>
                    <InputLabel for="done_at" value="Done at"/>

                    <TextInput
                        id="done_at"
                        type="datetime-local"
                        class="mt-1 block w-full"
                        v-model="form.done_at"
                        required
                        autofocus
                        autocomplete="done_at"
                    />

                    <InputError class="mt-2" :message="form.errors.done_at"/>
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
import {onMounted, watch, ref} from "vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import SaveButton from "@/Components/SaveButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps(['show', 'exercise', 'result'])
const emit = defineEmits(['close'])

const form = useForm({
    sets: 5,
    reps: 5,
    type: 'constant', // 'constant','variable'
    level: 'rx',
    weight: [],
    notes: '',
    done_at: ''
})

const getCurrentDateTime = () => {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    form.done_at = `${year}-${month}-${day}T${hours}:${minutes}`;
}

const closeModal = () => {
    emit('close')
}
onMounted(() => {
    //changeSets(5)
    getCurrentDateTime()
})

watch(props, (value) => {
    console.log(props.result)
    if (props.result.id) {
        form.sets = props.result.rounds
        form.reps = 5
        form.type = props.result.reps_type
        form.level = props.result.level
        form.weight = props.result.meta
    }else{
        form.sets = 5
        form.reps = 5
        form.type = 'constant'
        form.level = 'rx'
        form.weight = []

        changeSets(5)
    }
})

const savePost = () => {
    form.post(route('results.store', props.exercise))
    closeModal()
}

watch(() => form.type, (newValue, oldValue) => {
    changeSets(form.sets)
});

watch(() => form.sets, (newValue, oldValue) => {
    changeSets(newValue)
});

watch(() => form.reps, (newValue, oldValue) => {
    if (form.type === 'constant') {
        form.weight.map(item => item.reps = newValue)
    }
})

const changeSets = (value) => {
    if (form.type === 'constant') {
        form.weight = []; // Clear previous objects
        for (let i = 0; i < value; i++) {
            form.weight.push({
                number: i + 1,
                reps: form.reps,
                value: '',
                percent: 100,
            });
        }
    } else if (form.type === 'variable') {
        form.weight = []; // Clear previous objects
        for (let i = 0; i < value; i++) {
            form.weight.push({
                number: i + 1,
                reps: 0,
                value: '',
                percent: 100,
            });
        }
    }
}
</script>
