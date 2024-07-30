<template>
    <!-- Toggle -->
    <div class="flex justify-center mb-3">
        <div id="toggle-count" class="p-0.5 inline-block bg-gray-100 rounded-lg dark:bg-neutral-700">

            <label v-for="item in items" :for="'toggle-count-' + item" class="relative inline-block py-2 px-3">
                  <span class="inline-block relative z-10 text-sm font-medium text-gray-800 cursor-pointer dark:text-neutral-200">
                    {{item}}
                  </span>
                <input v-model="model" :value="item"
                       ref="input" :id="'toggle-count-' + item" name="toggle-count" type="radio"
                       class="absolute top-0 end-0 size-full border-transparent bg-transparent bg-none text-transparent rounded-lg cursor-pointer before:absolute before:inset-0 before:size-full before:rounded-lg focus:ring-offset-0 checked:before:bg-white checked:before:shadow-sm checked:bg-none focus:ring-transparent dark:checked:before:bg-neutral-800 dark:focus:ring-offset-transparent">
            </label>
        </div>
    </div>
    <!-- End Toggle -->
</template>
<script setup>
import {ref} from "vue";

const props = defineProps(['items'])
const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);
</script>
