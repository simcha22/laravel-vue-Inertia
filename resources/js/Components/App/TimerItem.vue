<template>
    <div class="flex justify-center">
        <button type="button" @click="startTimer" v-if="!is_timer_play"
                class="flex items-center text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"/>
            </svg>
            <span class="ml-1">Start</span>
        </button>
        <button type="button" @click="stopTimer" v-if="is_timer_play"
                class=" flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z"/>
            </svg>
            <span class="ml-1">Stop</span>
        </button>

        <button type="button" @click="restartTimer" v-if="!is_timer_play"
                class=" flex items-center text-purple-700 hover:text-white border border-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
            </svg>
            <span class="ml-1">Restart</span>
        </button>
    </div>
    <div>
        <p class="text-center">Time camp = {{ time }} minutes</p>
    </div>
    <div class="flex items-center justify-center h-96">

        <!-- Circular Progress -->
        <div class="relative size-40">
            <svg class="size-full -rotate-90" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                <!-- Background Circle -->
                <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-gray-200 dark:text-neutral-700" stroke-width="2"></circle>
                <!-- Progress Circle -->
                <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-emerald-600 dark:text-blue-500" stroke-width="1" stroke-dasharray="100" :stroke-dashoffset="progress" stroke-linecap="round"></circle>
            </svg>

            <!-- Percentage Text -->
            <div class="absolute top-1/2 start-1/2 transform -translate-y-1/2 -translate-x-1/2">
                <span class="text-center text-2xl font-bold text-emerald-600 dark:text-blue-500">{{ formatTime }}</span>
            </div>
        </div>
        <!-- End Circular Progress -->
    </div>


</template>

<script setup>
import {ref, computed} from 'vue'

const props = defineProps(['time'])
const seconds = ref(0)
const minutes = ref(0)
const timer = ref(null)
const is_timer_play = ref(false)
const progress = ref(100)


const formatTime = computed(() => {
    const mins = minutes.value < 10 ? `0${minutes.value}` : minutes.value;
    const secs = seconds.value < 10 ? `0${seconds.value}` : seconds.value;
    return `${mins}:${secs}`;
})

const startTimer = () => {
    if(!is_timer_play.value) {
        timer.value = setInterval(() => {
            let timeCamp = props.time.split(':')

            if (minutes.value == timeCamp[0] && seconds.value == timeCamp[1]) {
                stopTimer()
                return;
            }

            is_timer_play.value = true
            seconds.value++;
            let secondsTime = parseInt(timeCamp[0] * 60) + parseInt(timeCamp[1])

            progress.value = progress.value - (100 / secondsTime)

            if (seconds.value === 60) {
                seconds.value = 0;
                minutes.value++;
            }

        }, 1000);
    }
}

const stopTimer = () => {
    if(is_timer_play.value) {
        is_timer_play.value = false
        clearInterval(timer.value);
    }
}

const restartTimer = () => {
    if(!is_timer_play.value) {
        clearInterval(timer.value);

        seconds.value = 0
        minutes.value = 0
        timer.value = null
        progress.value = 100

        startTimer()
    }
}
</script>

<style scoped>
/* @keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.animate-spin-slow {
    animation: spin 60s linear infinite;
}*/
</style>
