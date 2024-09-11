<template>
    <Modal :show="show" @close="emit('close')">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
               Add Workout Results
            </h2>

            <form @submit.prevent="savePost" class="space-y-6">
            </form>
        </div>
    </Modal>
</template>
<script setup >
import Modal from "@/Components/Modal.vue";

const props = defineProps(['show'])
const emit = defineEmits(['close'])

const savePost = () =>{

}
</script>
