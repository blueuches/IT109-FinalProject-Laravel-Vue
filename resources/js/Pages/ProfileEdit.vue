<template>
    <GuestLayout>
        <Head title="Edit Profile" />
        <div class="container mx-auto p-4">
            <h1 class="text-4xl font-bold mb-4">Edit Profile</h1>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <InputLabel for="profile_picture" value="Profile Picture" />
                    <input type="file" id="profile_picture" @change="handleProfilePictureChange" />
                    <InputError class="mt-2" :message="form.errors.profile_picture" />
                </div>
                <div class="mb-4">
                    <InputLabel for="cover_photo" value="Cover Photo" />
                    <input type="file" id="cover_photo" @change="handleCoverPhotoChange" />
                    <InputError class="mt-2" :message="form.errors.cover_photo" />
                </div>
                <div class="mb-4">
                    <InputLabel for="bio" value="Bio" />
                    <textarea id="bio" v-model="form.bio" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                    <InputError class="mt-2" :message="form.errors.bio" />
                </div>
                <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Update Profile
                </PrimaryButton>
            </form>
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
});

const form = useForm({
    profile_picture: null,
    cover_photo: null,
    bio: props.user.profile?.bio || '',
});

const handleProfilePictureChange = (event) => {
    form.profile_picture = event.target.files[0];
};

const handleCoverPhotoChange = (event) => {
    form.cover_photo = event.target.files[0];
};

const submit = () => {
    form.post(route('profile.formupdate'), {
        onFinish: () => form.reset('profile_picture', 'cover_photo')
    });
};
</script>
