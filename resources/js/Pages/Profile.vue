<template>
    <GuestLayout>
        <Head :title="`Profile - ${user.username}`" />
        <div class="container mx-auto p-4">
            <!-- Cover Photo -->
            <div class="relative bg-gray-200 h-72 rounded-lg overflow-hidden">
            <img
                :src="user.profile?.cover_photo ? `/${user.profile.cover_photo}` : 'defaultbg.png'"
                alt="Cover Photo"
                class="w-full h-full object-cover"
            />
            <!-- Profile Picture -->
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <img
                :src="user.profile?.profile_picture ? `/${user.profile.profile_picture}` : 'defaultpic.png'"
                alt="Profile Picture"
                class="w-32 h-32 rounded-full border-4 border-white object-cover"
                onerror="this.src='/storage/defaultpic.png'"
                />
            </div>
            </div>

            <!-- User Info -->
            <div class="mt-16 text-center">
                <h1 class="text-4xl font-bold mb-2">{{ user.username }}</h1>
                <p class="text-lg text-gray-600 mb-4">{{ user.profile.bio }}</p>
                <Link :href="route('profile.form')">
                    <button class="px-4 py-2 bg-[#a2cf6e] text-white rounded-lg shadow-md hover:bg-green-700" v-if="$page.props.auth.user?.id === user.id">
                    Edit Profile
                    </button>
                </Link>
            </div>

            <!-- Posts Section -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-4">Posts</h2>
                <div class="space-y-4">
                    <div
                        v-for="post in user.posts"
                        :key="post.id"
                        class="bg-white shadow rounded-lg p-4"
                    >
                        <div class="flex items-center mb-4">
                            <img
                                :src="user.profile && user.profile.profile_picture ? `/${user.profile.profile_picture}` : '/storage/defaultpic.png'"
                                alt="Profile Picture"
                                class="w-10 h-10 rounded-full object-cover"
                            />
                            <div class="ml-3">
                                <h3 class="font-bold text-lg">{{ user.username }}</h3>
                                <p class="text-sm text-gray-500">{{ post.created_at }}</p>
                            </div>
                        </div>
                        <h4 class="font-bold text-lg mb-2">
                            <Link
                                :href="route('frontend.communities.posts.show', [post.community.slug, post.slug])"
                                class="text-blue-500 hover:underline"
                            >
                                {{ post.title }}
                            </Link>
                        </h4>
                        <p class="text-gray-700">{{ post.content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
});
</script>
