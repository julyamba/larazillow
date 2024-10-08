<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center">
            <div v-if="list.images.length" class="grid grid-cols-2 gap-1">
                <img v-for="image in list.images" :key="image.id" :src="image.src">
            </div>
            <div v-else class="w-full text-center font-medium text-gray-500">No images</div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Basic info
                </template>
                <Price :price="list.price" class="text-2xl font-bold" />
                <ListingSpace :list="list" class="text-lg"/>
                <ListingAddress :list="list" class="text-gray-500"/>
            </Box>
            <Box>
                <template #header>Monthly Payment</template>
                <div>
                    <label class="label">Interest rate ({{ interestRate }}%)</label>
                    <input type="range" min="0.1" max="30" step="0.1" class="input-range" v-model.number="interestRate">

                    <label class="label">Duration ({{ duration }} years)</label>
                    <input type="range" min="3" max="35" step="1" class="input-range"  v-model.number="duration"/>

                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" class="text-3xl" />
                    </div>

                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Total paid</div>
                            <div>
                                <Price :price="totalPaid" class="font-medium"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Principal paid</div>
                            <div>
                                <Price :price="list.price" class="font-medium"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Interest paid</div>
                            <div>
                                <Price :price="totalInterest" class="font-medium"/>
                            </div>
                        </div>
                    </div>
                </div>
            </Box>
        </div>        
    </div> 
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import ListingAddress from '@/Components/ListingAddress.vue';
import ListingSpace from '@/Components/ListingSpace.vue';
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'

import { ref } from 'vue'

import { useMonthlyPayment } from '@/Composables/useMonthlyPayment';

const interestRate = ref(2.5)
const duration = ref(25)

const props = defineProps({
    list : Object        
})

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.list.price, interestRate, duration)

</script>