<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    post: Object,
    community: Object,
});

const form = useForm({
    title: props.post?.title,
    description: props.post?.description,
    url: props.post?.url,
});

const submit = () => {
    form.put(route('communities.posts.update',[props.community.slug, props.post.slug]));
};
</script>

<template>
    <Head title="Create Community" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Update Post for {{ community.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="max-w-md mx-auto bg-white-200 m-2 p-6">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="title" value="Title" />

                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                autofocus
                                autocomplete="title"
                            />

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="description" value="Description" />

                            <textarea id="description" class="mt-1 block w-full h-40 p-2 border-gray-300 rounded-md shadow-sm focus:border-green-600 focus:ring focus:ring-green-600 focus:ring-opacity-50" 
                            v-model="form.description" 
                            autocomplete="description" >
                            </textarea>

                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>


                        <div class="mt-4 flex items-center justify-end">

                            <PrimaryButton
                                class="ms-4 bg-[#a2cf6e] hover:bg-green-700"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Update
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
