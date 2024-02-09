<template>
    <div class="flex items-center justify-center">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 pb-8 bg-blue-950 dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <InputLabel for="filter" value="Select filter" class="block mb-2 text-white" />

            <select v-model="selectedFilter" id="filter" class="bg-gray-700 text-white w-full border rounded-md p-2 mb-4">
                <option v-for="filter in filters" :key="filter" :value="filter">{{ filter }}</option>
            </select>

            <InputLabel for="search" value="Search term" class="block mb-2 text-white" />

            <TextInput
                id="search"
                class="w-full border p-2 mb-4"
                v-model="searchTerm"
                @keydown.enter="search"
            />

            <div class="flex flex-col-reverse md:flex-row justify-end">
                <InputLabel for="hideKegs" value="Hide Kegs" class="block text-white md:mr-2" />
                <CheckboxComponent v-model="hideKegs" id="hideKegs" @update:checked="filterResults" />
            </div>

            <primary-button @click="search" class="w-full text-white mt-4 p-4 rounded-md">Search</primary-button>

            <div v-if="error" class="text-red-500 mt-6 text-center">
                {{ error }}
            </div>

            <div v-if="(searching && searchResults !== null && searchResults.length < 1) || (!searching && searchResults === null)" class="text-white mt-4 text-center">
                No results found.
            </div>
        </div>
    </div>

    <SearchResults :searchResults="searchResults" v-if="searchResults.length" />
</template>

<script>
import SearchResults from '@/Components/Search/SearchResults.vue';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import CheckboxComponent from "@/Components/Checkbox.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    components: {
        PrimaryButton,
        CheckboxComponent,
        TextInput,
        InputLabel,
        SearchResults,
    },
    data() {
        return {
            filters: ['Name', 'ID'],
            selectedFilter: 'Name',
            searchTerm: '',
            searchResults: [],
            searching: false,
            error: null,
            hideKegs: false,
        };
    },
    methods: {
        async search() {
            try {
                this.handleInputValidation();

                const response = await axios.get('/api/search', {
                    params: {
                        filter: this.selectedFilter,
                        search: this.searchTerm,
                    },
                });

                if (response && response.data && response.data.searchResults) {
                    this.searchResults = this.hideKegs
                        ? response.data.searchResults.filter(result => !result.image_url.includes('keg.png'))
                        : response.data.searchResults;

                    this.searching = false;
                } else {
                    this.searchResults = [];
                    this.searching = true;
                }
            } catch (error) {
                this.searchResults = [];
                this.searching = true;
                this.error = 'Error searching for beers';
                console.error('Error searching for beers:', error);
            }
        },
        handleInputValidation() {
            if (this.selectedFilter === 'Name' && !/^.*$/.test(this.searchTerm)) {
                this.error = 'Invalid characters for Name search';
            } else if (this.selectedFilter === 'ID' && !/^\d+$/.test(this.searchTerm)) {
                this.error = 'Invalid characters for ID search';
            } else {
                this.error = null;
            }
        },
        filterResults() {
            this.search();
        },
    },
};
</script>
