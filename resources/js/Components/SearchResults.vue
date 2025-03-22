<template>
    <div>
        <h1>Search Results for "{{ query }}"</h1>
        
        <h2>Communities</h2>
        <div v-if="communities.length">
            <ul>
                <li v-for="community in communities" :key="community.id">
                    {{ community.name }}
                </li>
            </ul>
        </div>
        <div v-else>
            No communities found.
        </div>

        <h2>Posts</h2>
        <div v-if="posts.length">
            <ul>
                <li v-for="post in posts" :key="post.id">
                    {{ post.title }}
                </li>
            </ul>
        </div>
        <div v-else>
            No posts found.
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    communities: Array,
    posts: Array,
    query: String,
});
</script>
