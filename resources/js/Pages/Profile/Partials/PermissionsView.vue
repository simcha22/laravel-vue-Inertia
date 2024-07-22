<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profile Permissions:</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">

            </p>
        </header>

        <div v-for="permission in permissions">
            <span class="bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-pink-400 border border-pink-400">{{permission}}</span>
        </div>
    </section>
</template>

<script>

import {ref} from "vue";
import {usePage} from "@inertiajs/vue3";

const permissions = ref()

permissions.value = usePage().props?.auth.permissions;

console.log(permissions.value)


</script>
