<template>
    <!-- <h2 style="width: 500px;">{{ message }}</h2> -->
    <br>
    <p>
        <Link :href="'/listing'">
            Listing
        </Link>
    </p>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps(
    {
        'message' : String
    }
)
</script>
