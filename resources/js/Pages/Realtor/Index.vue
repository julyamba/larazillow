<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>

    <section class="mb-8">
        <RealtorFilters :filters="filters" />
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <Box v-for="listing in listings.data" :key="listing.id" :class="{'border-dashed': listing.deleted_at}">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div :class="{'opacity-25': listing.deleted_at}">
                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium" />
                        <ListingSpace :list="listing" />
                    </div>

                    <ListingAddress :list="listing" class="text-gray-500"/>
                </div>

                <section>
                    <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                        <a v-if="!listing.deleted_at" target="_blank" class="btn-outline text-xs font-medium cursor-pointer" :href="route('listing.show', {listing})">Preview</a>

                        <Link class="btn-outline text-xs font-medium" :href="route('realtor.listing.edit',{listing})">Edit</Link>

                        <Link v-if="!listing.deleted_at" class="btn-outline text-xs font-medium" :href="route('realtor.listing.destroy', {listing})" as="button" method="delete">Delete</Link>

                        <Link v-else class="btn-outline text-xs font-medium" :href="route('realtor.listing.restore', {listing})" as="button" method="put">Restore</Link>
                    </div>

                    <div class="mt-2">
                        <Link :href="route('realtor.listing.image.create', {listing})" class="block w-full btn-outline text-xs font-medium text-center">Image</Link>
                    </div>
                </section>
            </div>
        </Box>
    </section>

    <section v-if="listings.data.length" class="w-full flex my-8">
        <Pagination :links="listings.links"/>
    </section>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import Price from '@/Components/Price.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import { Link } from '@inertiajs/vue3'
import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue'

defineProps({
    'listings': Object,
    'filters': Object
})
</script>