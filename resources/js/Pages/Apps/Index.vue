<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    apps: Array,
})
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
                <div v-for="app in apps" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p class="text-blue-900 font-bold pb-2">{{ app.name }}</p>
                        <a class="text-blue-700 block mb-2 hover:underline" :href="app.url">{{ app.url }}</a>
                        <ul>
                            <li class="mb-2">
                                <div><strong>Description:</strong></div>
                                <div>{{ app.description }}</div>
                            </li>
                            <li>
                                <strong>Username:</strong> {{ app.user_name }}
                            </li>
                            <li>
                                <strong>Password:</strong> {{ app.password }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
