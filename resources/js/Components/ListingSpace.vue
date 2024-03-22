<template>
    <div class="">
        <span class="font-bold">{{ list.beds }}</span> bds <span class="text-gray-400">| </span>
        <span class="font-bold">{{ list.baths }}</span> ba <span class="text-gray-400">| </span><span class="font-bold">{{ list.area }}</span> m²
    </div>  
</template>

<script setup>
defineProps({
    list: Object
})
</script>