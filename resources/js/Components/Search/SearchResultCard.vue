<template>
    <div class="bg-gray-800 p-4 mb-4 rounded-md flex items-center">
        <div class="flex-shrink-0 mr-4">
            <img :src="result.image_url" alt="Beer Image" class="rounded-md" style="width: 50%; height: 50%;">
        </div>

        <div>
            <h3 class="text-xl font-bold text-white mb-2">{{ result.name }}</h3>
            <div class="text-gray-500 font-italic pb-2">{{ result.tagline }}</div>
            <ul class="list-none list-inside text-gray-400">
                <li><span class="font-bold">ABV:</span> <span class="text-orange-500">{{ result.abv }}</span></li>
                <li><div class="font-bold pt-2">{{ result.description }}</div></li>
            </ul>
            <div class="mt-4">
                <p class="text-gray-300 font-bold">Food Pairings:</p>
                <ul class="list-disc list-inside text-gray-400 mt-2">
                    <li v-for="foodItem in result.food_pairing" :key="foodItem">{{ foodItem }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        result: {
            type: Object,
            required: true,
        },
    },
};
</script>
