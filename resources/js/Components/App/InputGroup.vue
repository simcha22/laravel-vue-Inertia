<template>
    <div class="max-w-sm space-y-3 mr-2">
        <div>
            <div class="flex rounded-lg shadow-sm h-[66px]">
                <div class="px-4 inline-flex items-center min-w-fit rounded-s-md border border-e-0 border-gray-200 bg-gray-50 dark:bg-neutral-700 dark:border-neutral-600">
                    <span class="text-sm text-gray-500 dark:text-neutral-400">#{{number}}</span>
                </div>
                <input type="text" v-model="model" ref="input" name="hs-input-with-add-on-url" id="hs-input-with-add-on-url" class="py-3 px-4 pe-11 block w-full border-gray-200 shadow-sm text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <div class="px-4 inline-flex items-center min-w-fit rounded-e-md border border-s-0 border-gray-200 bg-gray-50 dark:bg-neutral-700 dark:border-neutral-600">
                    <span class="text-sm text-gray-500 dark:text-neutral-400">X {{reps}}</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {onMounted, ref} from "vue";

const props = defineProps(['number', 'reps'])

const model = defineModel({
    type: Number,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({focus: () => input.value.focus()});

</script>
