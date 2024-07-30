<template>
    <Modal :show="show" @close="closeModal" side="center">
        <div class="p-6">
            <form @submit.prevent="savePost" class="space-y-6">
            <div>
                <RadioInput v-model="form.type" :items="['constant','variable']"/>
            </div>
            <div class="flex justify-center">
                <div class="mr-2  w-1/2 text-center">
                    <InputLabel for="sets" value="Sets" />
                    <InputNumber id="sets" v-model="form.sets"/>
                </div>
                <div class="mr-2 w-1/2 text-center">
                    <InputLabel for="reps" value="Reps" />
                    <InputNumber id="reps" v-model="form.reps"/>
                </div>
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

const props = defineProps(['show'])
const emit = defineEmits(['close'])

const form = useForm({
    sets: 5,
    reps: 5,
    type: 'constant', // 'constant','variable'
})
const closeModal = () => {
    emit('close')
}

const savePost = () =>{

}
</script>
