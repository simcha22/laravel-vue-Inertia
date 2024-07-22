<template>
    <select
        :id="id"
        :name="name"
        class="inline-block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-cyan-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-center"
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

