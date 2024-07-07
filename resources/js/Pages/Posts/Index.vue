<script setup>
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {Head} from "@inertiajs/vue3";

    const props = defineProps(['posts'])

    console.log(props.posts)
</script>

<template>
    <Head title="Posts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Posts</h2>
        </template>


    </AuthenticatedLayout>

</template>
