<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import {computed} from "vue"
import { ref } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3'
import CopyButton from '@/Components/CopyButton.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const props = defineProps({
    apps: Array,
})

const state = ref({
    filter: ''
})

const form = useForm({});

const showPasswords = ref([])

const filtered = computed(() => props.apps.filter(app => {
  return  app.name.toLowerCase().includes(state.value.filter.toLowerCase())
}))

function toggleShow(id) {
    showPasswords.value[id] = !showPasswords.value[id];
}

function deleteApp(id) {
    confirm('are you sure')
    form.delete(`/apps/${id}`)
}
</script>

<template>
    <Head title="Passwords" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-md text-gray-800 leading-tight lg:text-xl">
                Your Passwords
            </h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-2 mx-4 lg:mx-0">Filter:
                    <BreezeInput id="name"
                                 type="text"
                                 class="mt-1 block w-full"
                                 v-model="state.filter"
                    />
                </div>
                <div v-for="app in filtered" class="bg-white overflow-hidden shadow-sm sm:rounded-lg lg:my-2">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between">
                            <p class="text-blue-900 font-bold pb-2">{{ app.name }}</p>
                            <div>
                                <Link :href="`/apps/edit/${app.id}`"
                                      type="button"
                                      class="border rounded px-2 hover:bg-gray-50 mr-1"
                                >
                                    edit
                                </Link>
                                <button class="border rounded px-2 hover:bg-red-600 bg-red-400 text-white"
                                        @click.prevent="deleteApp(app.id)"
                                >delete</button>
                            </div>
                        </div>

                        <a class="text-blue-700 inline-block mb-2 hover:underline" :href="app.url">{{ app.url }}</a>
                        <ul>
                            <li class="mb-2">
                                <div><strong>Description:</strong></div>
                                <div>{{ app.description }}</div>
                            </li>
                            <li>
                                <strong>Username:</strong> {{ app.user_name }}
                                <copy-button :val="app.user_name" />
                            </li>
                            <li class="mt-2">
                                <strong>Password:</strong>
                                <span class="mx-2" :id="`password-${app.id}`">
                                    <template v-if="showPasswords[app.id]">{{ app.password }}</template>
                                    <template v-else>
                                        <font-awesome-icon icon="fa-solid fa-circle"
                                                           class="text-xs mx-[0.5px]"
                                                           v-for="i in [...Array(8).keys()]"
                                        />
                                    </template>
                                </span>
                                <button @click="toggleShow(app.id)" class="text-gray-500">
                                    <span v-if="showPasswords[app.id]">
                                        <font-awesome-icon icon="fa-solid fa-eye" />
                                    </span>
                                    <span v-else>
                                        <font-awesome-icon icon="fa-solid fa-eye-slash" />
                                    </span>
                                </button>
                                <copy-button :val="app.password" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
