<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
    communities: Object,
})
</script>
<template>
    <Head title="All Communities" />
    <GuestLayout>
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-[#2e6b38]">
                Choose your community and click on its names to see more posts!!
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow sm:rounded-lg">
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase"
                                    >
                                        Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase"
                                    >
                                        Key
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="community in communities" :key="community.id">
                                    <Link :href="route('frontend.communities.show',community.slug)">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ community.name }}
                                        </td>
                                    </Link>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ community.slug }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>