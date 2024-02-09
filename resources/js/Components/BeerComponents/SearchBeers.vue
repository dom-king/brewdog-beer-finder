<template>
    <div class="mt-4 flex items-center justify-center">
        <div class="bg-blue-950 p-8 shadow-md rounded-md w-96">

            <label for="filter" class="block mb-2 text-white">Select filter:</label>
            <select v-model="selectedFilter" id="filter" class="w-full border p-2 mb-4">
                <option v-for="filter in filters" :key="filter" :value="filter">{{ filter }}</option>
            </select>

            <label for="search" class="block mb-2 text-white">Search term:</label>
            <input v-model="searchTerm" id="search" class="w-full border p-2 mb-4" />

            <button @click="search" class="w-full bg-blue-500 text-white mt-4 p-4 rounded-md">Search</button>
        </div>
    </div>

    <SearchResults :searchResults="searchResults" v-if="searchResults.length" />
</template>

<script>
import SearchResults from '@/Components/BeerComponents/SearchResults.vue';

export default {
    components: {
        SearchResults,
    },
    data() {
        return {
            filters: ['ID', 'Name'],
            selectedFilter: 'ID',
            searchTerm: '',
            searchResults: [],
        };
    },
    methods: {
        async search() {
            try {
                const response = await axios.get('/api/search', {
                    params: {
                        filter: this.selectedFilter,
                        search: this.searchTerm,
                    },
                });

                console.log('API Response:', response.data);

                if (response && response.data && response.data.searchResults) {
                    this.searchResults = response.data.searchResults;
                } else {
                    console.error('Invalid response format:', response);
                }
            } catch (error) {
                if (error.response) {
                    console.error('Error searching for beers:', error.response.data);
                } else {
                    console.error('Error searching for beers:', error.message);
                }
            }
        },
    },
};
</script>
