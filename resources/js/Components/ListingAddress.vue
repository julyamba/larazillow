<template>
    <span class="">
        {{ list.street }} {{ list.street_nr }}, {{ list.city }}
    </span>    
</template>

<script setup>
defineProps({
    list: Object
})
</script>