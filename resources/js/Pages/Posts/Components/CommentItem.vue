<script setup>
    import useTime from "@/Composteble/time.js";
    import {ref} from "vue";
    import Modal from "@/Components/Modal.vue";
    import SecondaryButton from "@/Components/SecondaryButton.vue";
    import DangerButton from "@/Components/DangerButton.vue";
    import {router, useForm} from "@inertiajs/vue3";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import InputError from "@/Components/InputError.vue";

    const props = defineProps(['comment'])

    const showDropdown = ref(false)
    const confirmingCommentDeletion = ref(false)
    const showEditComment = ref(false)
    const {formatMessageDateShort} = useTime()

    const form = useForm({
        text: props.comment.text
    })

    const deleteComment = () => {
        router.delete(route('comments.destroy', props.comment.id))
        closeModal()
    }

    const closeModal =() =>{
        confirmingCommentDeletion.value = false
        showDropdown.value = false
        showEditComment.value = false
    }

    const editComment = () =>{
        form.patch(route('comments.update', props.comment.id))
        closeModal()
    }
</script>

<template>

    <div class="flex items-start gap-2.5 m-2">
        <img class="w-8 h-8 rounded-full" src="@/assets/Images/avatar.jpeg" alt="Jese image">
        <div class="flex flex-col w-full max-w-[420px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-xl dark:bg-gray-700">
            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{comment.user_name}}
                </span>
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{formatMessageDateShort(comment.created_at) }}</span>
            </div>
            <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{{comment.text}}</p>
       </div>
        <button @click="showDropdown = !showDropdown" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600" type="button">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
            </svg>
        </button>
        <div v-if="showDropdown" class="z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" >
                <li>
                    <a @click="showEditComment = true" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                </li>
                <li>
                    <a @click="confirmingCommentDeletion = true" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                </li>
            </ul>
        </div>
    </div>

    <Modal :show="confirmingCommentDeletion" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Are you sure you want to delete this comment?
            </h2>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                <DangerButton
                    class="ms-3"
                    @click="deleteComment"
                >
                    Delete Comment
                </DangerButton>
            </div>
        </div>
    </Modal>


    <Modal :show="showEditComment" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Edit Comment
            </h2>

            <div class="mt-6">
                <InputLabel for="text" value="Comment" class="sr-only" />

                <textarea
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    id="text"
                    v-model="form.text"
                ></textarea>

                <InputError :message="form.errors.text" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                <PrimaryButton
                    class="ms-3"
                    @click="editComment"
                >
                    Edit
                </PrimaryButton>
            </div>
        </div>
    </Modal>

</template>
