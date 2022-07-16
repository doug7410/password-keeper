<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3'

const form = useForm({
    name: '',
    description: '',
    url: '',
    user_name: '',
    password: '',
});

const submit = () => {
    form.post(route('save_app'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Passwords" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Your Passwords
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
                            Create a new password
                        </h2>
                        <form @submit.prevent="submit">
                            <div>
                                <BreezeLabel for="name" value="Name" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="description" value="Description" />
                                <BreezeInput id="description" type="text" class="mt-1 block w-full" v-model="form.description" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="url" value="Url" />
                                <BreezeInput id="url" type="text" class="mt-1 block w-full" v-model="form.url" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="user_name" value="User Name" />
                                <BreezeInput id="user_name" type="text" class="mt-1 block w-full" v-model="form.user_name" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="password" value="Password" />
                                <BreezeInput id="password" type="text" class="mt-1 block w-full" v-model="form.password" required />
                            </div>

                            <div class="flex justify-start mt-4">
                                <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
