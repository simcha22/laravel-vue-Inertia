<template>
    <Modal :show="show" @close="closeModal" side="right">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                 Exercise {{exercise.name}}
            </h2>
        </div>
    </Modal>
</template>
<script setup>
import Modal from "@/Components/Modal.vue";

const props = defineProps(['show', 'exercise'])

const closeModal = () =>{

}
</script>
