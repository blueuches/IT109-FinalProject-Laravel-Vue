<template>
    <div class="mt-4 max-w-4xl flex bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800">
        <div>
            <div class="flex m-2 p-2 text-sm">
                <Link :href="route('frontend.communities.show', community.slug)" class="font-semibold mr-3 hover:text-green-700">
                    {{ community.name }}
                </Link>
            </div>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ community.description }}
            </p>

        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    community: Object
});
</script>
