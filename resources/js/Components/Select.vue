<template>
    <select
        :id="id"
        :name="name"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    >
        <option
            v-for="(value) in items"
            :value="value.id"
            :key="value.id"
        >
             {{ value.name  }}
        </option>
    </select>
</template>

<script>
export default {
    props: ["modelValue", "items", "id", "name"],

    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
};
</script>

<style  scoped>
option {
    height: 20px;
}
</style>

