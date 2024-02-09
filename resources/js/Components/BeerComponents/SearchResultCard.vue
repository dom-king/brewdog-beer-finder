<template>
    <div class="bg-gray-800 p-4 mb-4 rounded-md flex items-center">
        <div class="flex-shrink-0 mr-4">
            <img :src="result.image_url" alt="Beer Image" class="rounded-md" style="width: 50%; height: 50%;">
        </div>

        <div>
            <h3 class="text-lg font-bold text-white">{{ result.name }}</h3>
            <ul class="list-disc list-inside text-gray-400">
                <li><span class="font-bold">Tagline:</span> {{ result.tagline }}</li>
                <li><span class="font-bold">ABV:</span> {{ result.abv }}</li>
                <li><span class="font-bold">Description:</span> {{ result.description }}</li>
            </ul>

            <div class="mt-2">
                <p class="text-gray-300 font-bold">Food Pairings:</p>
                <ul class="list-disc list-inside text-gray-400">
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
