<template>
    <Box>
        <div>
            <Link :href="route('listing.show', {listing: listing.id})">
                <div class="flex items-center gap-1">
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" /> pm
                    </div>
                </div>
                <ListingSpace :list="listing" class="text-lg"/>
                <ListingAddress :list="listing" class="text-gray-500"/>
            </Link>
        </div>
    </Box>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Box from '@/Components/UI/Box.vue';
import ListingAddress from '@/Components/ListingAddress.vue';
import ListingSpace from '@/Components/ListingSpace.vue';
import Price from '@/Components/Price.vue'

import { ref } from 'vue'

import { useMonthlyPayment } from '@/Composables/useMonthlyPayment';

const props = defineProps({
    listing : Object
})

const interestRate = ref(2.5)
const duration = ref(25)

const { monthlyPayment } = useMonthlyPayment(props.listing.price, interestRate, duration)

</script>