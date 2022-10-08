<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { ref } from "vue"

const copied = ref(false)

const props = defineProps({
    val: String
})

function copyToClipboard() {
    navigator.clipboard.writeText(props.val);
    copied.value = true;
    setTimeout(() => copied.value = false, 2000)
}
</script>


<template>
    <font-awesome-icon icon="fa-solid fa-copy" @click="copyToClipboard" class="mx-1.5 cursor-pointer text-gray-500" />
    <transition>
        <span v-if="copied">copied</span>
    </transition>
</template>

<style scoped>
.v-enter-active {
    transition: opacity 0.2s ease;
}

.v-leave-active {
    transition: opacity 120ms ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
