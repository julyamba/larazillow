<template>
    <p style="width: 500px;">{{ message }}</p>
</template>

<script setup>
const props = defineProps(
    {
        'message' : String
    }
)
</script>

