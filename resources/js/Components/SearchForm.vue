<template>
    <div class="flex justify-center items-center my-4">
        <form @submit.prevent="submit" class="flex w-full max-w-sm space-x-3">
            <div class="relative w-full">
                <input
                    type="text"
                    v-model="form.query"
                    placeholder="Search..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <!-- You can add an icon here if needed -->
                </div>
            </div>
            <button
                type="submit"
                class="px-4 py-2 font-semibold text-white bg-[#2e6b38] rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75"
            >
                Search
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({ query: '' });

const submit = () => {
    form.get(route('search'), {
        preserveState: true,
    });
};
</script>

