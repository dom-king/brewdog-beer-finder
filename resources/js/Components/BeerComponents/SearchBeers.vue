<template>
    <div class="mt-4 flex items-center justify-center">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 pb-8 bg-blue-950 dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">

            <InputLabel for="filter" value="Select filter" class="block mb-2 text-white" />

            <select v-model="selectedFilter" id="filter" class="w-full border p-2 mb-4">
                <option v-for="filter in filters" :key="filter" :value="filter">{{ filter }}</option>
            </select>

            <InputLabel for="search" value="Search term" class="block mb-2 text-white" />

            <TextInput
                id="search"
                class="w-full border p-2 mb-4"
                v-model="searchTerm"
            />

            <SecondaryButton @click="search" class="w-full text-white mt-4 p-4 rounded-md">Search</SecondaryButton>

            <div v-if="searching && searchResults.length === 0" class="text-white mt-4">
                No results found.
            </div>
        </div>
    </div>

    <SearchResults :searchResults="searchResults" v-if="searchResults.length" />
</template>

<script>
import SearchResults from '@/Components/BeerComponents/SearchResults.vue';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

export default {
    components: {
        SecondaryButton,
        TextInput,
        InputLabel,
        SearchResults,
    },
    data() {
        return {
            filters: ['ID', 'Name'],
            selectedFilter: 'ID',
            searchTerm: '',
            searchResults: [],
            searching: false,
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
