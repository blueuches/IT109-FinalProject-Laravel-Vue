<template>
    <GuestLayout>
        <Head title="Ceesius" />
        <div class="bg-slate-100 text-white py-20 text-center shadow-lg">
                <h1 class="text-6xl font-extrabold mb-4" style="color: #a2cf6e;">Browse latest post in Ceesius!</h1>
                <p class="text-xl font-medium" style="color: #a2cf6e;">Search Results for "{{ query }}"</p>
        </div>
        <section  class="flex md:flex-row m-2 p-2 ">
            <div class="w-full md:w-1/2 mb-4 md:mb-0">
                <h2 class="text-2xl font-bold mb-4" style="color: #a2cf6e;">Posts</h2>
                <div v-if="posts.data.length">
                    <PostCard v-for="post in posts.data" :post="post" :community="post.community_slug" :key="post.id"/>
                </div>
                <div v-else> No posts found. </div>
            </div>
            <div class="w-full md:w-1/2">
                <h2 class="text-2xl font-bold mb-4" style="color: #a2cf6e;">Communities</h2>
                <div v-if="communities.data.length">
                    <CommunityCard v-for="community in communities.data" :community="community" :key="community.id"/>
                </div>
                <div v-else> No communities found. </div>
            </div>
        </section>
    </GuestLayout>
    </template>
    
    <script  setup>
    import GuestLayout from "@/Layouts/GuestLayout.vue";
    import PostCard from "@/Components/PostCard.vue";
    import {Head} from "@inertiajs/vue3"
    import CommunityCard from "@/Components/CommunityCard.vue";
    
    const props = defineProps({
        communities: Object,
        posts: Object,
        query: String
    })
    </script>