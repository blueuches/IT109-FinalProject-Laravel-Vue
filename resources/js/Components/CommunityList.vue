<template>
    <div class="w-full bg-white shadow-md border rounded-lg">
        <h2 class="bg-[#a2cf6e] font-semibold text-lg p-6 text-white rounded-lg">
            <slot name="title"/>
        </h2>
        <ul role="list" class="divide-y divide-slate-300 dark:divide-slate-700 p-4">
            <li v-for="community in communities" :key="community.id" class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                    <Link :href="route('frontend.communities.show',community.slug)" class="text-slate-800 darK:text-slate-400 font-semibold truncate text-sm hover:text-green-700">
                        {{ community.name}}
                    </Link>
                    <div>
                        Posts ({{ community.posts_count }})
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    communities: Object,
})
</script>