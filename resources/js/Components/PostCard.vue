<template>
    <div class="mt-4 max-w-4xl flex bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800">
        <div class="mr-3">
            <PostVote :post="post"></PostVote>
        </div>
        <div>
            <div class="flex m-2 p-2 text-sm">
            <Link :href="route('frontend.communities.show', community)" class="font-semibold mr-3 hover:text-green-700">r/{{ community }}</Link>
            <div class="flex">Posted by 
                <Link @click.prevent="handleReadMore" :href="route('profile.show',post.username)"><span class="font-semibold mx-1"> {{ post.username }} </span></Link>
                
                {{ post.created_at }}
            </div>
            </div>
            <Link @click.prevent="handleReadMore" :href="route('frontend.communities.posts.show',[community, post.slug])">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:text-green-700">
                {{ post.title }}
            </h5>
            </Link>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            {{post.description}}
            </p>

            <div class="flex m-2 p-2">
            <p class="mr-4 p-2">Comments ({{ post.comments_count }})</p>
            <Link @click.prevent="handleReadMore" :href="route('frontend.communities.posts.show',[community, post.slug])" class="bg-[#a2cf6e] inline-flex items-center py-2 px-4 text-sm font-medium text-white rounded-lg hover:bg-[#2e6b38] focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Read more
                <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 3a1 1 0 01.832.445l5 7a1 1 0 01-1.664 1.11L10 5.778 5.832 11.555a1 1 0 01-1.664-1.11l5-7A1 1 0 0110 3zm0 10a1 1 0 00-.832.445l-5 7a1 1 0 001.664 1.11L10 14.222l4.168 5.333a1 1 0 001.664-1.11l-5-7A1 1 0 0010 13z" clip-rule="evenodd"></path>
                </svg>
            </Link>
            </div>
        </div>
    </div>

</template>

<script setup>
import {Link, usePage} from "@inertiajs/vue3"
import PostVote from "./PostVote.vue";

defineProps({
    post: Object,
    community: String
})

const page = usePage(); 

const handleReadMore = (event) => { 
    if (!page.props.auth.user) { event.preventDefault(); window.location.href = route('login'); } 
    
    };
</script>