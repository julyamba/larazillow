<template>
    <Filters :filters="filters" />
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Listing v-for="list in listings.data" :key="list.id" :listing="list" />
    </div>  

    <div v-if="listings.data.length" class="w-full flex my-8">
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>
import Listing from '@/Pages/Listing/Index/Components/Listing.vue';
import Pagination from '@/Components/UI/Pagination.vue';
import Filters from '@/Pages/Listing/Index/Components/Filters.vue';

defineProps({
    listings : Object,
    filters : Object
})
</script>