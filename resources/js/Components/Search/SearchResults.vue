<template>
    <div class="mt-8 pb-8">
        <div class="w-full md:w-4/5 lg:w-3/4 xl:w-2/3 2xl:w-1/2 mx-auto">
            <div v-if="searchResults.length > itemsPerPage" class="flex justify-between mb-6 items-center">
                <button @click="prevPage" :disabled="currentPage === 1" class="text-white">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        class="h-6 w-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </button>

                <span class="text-white">{{ currentPage }} / {{ totalPages }}</span>

                <button @click="nextPage" :disabled="currentPage === totalPages" class="text-white">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        class="h-6 w-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </button>
            </div>
        </div>

        <div v-if="isLoading" class="flex justify-center items-center h-24">
            <div class="animate-spin rounded-full border-t-4 border-blue-500 border-opacity-25 h-12 w-12"></div>
        </div>

        <div v-else>
            <div v-if="paginatedResults.length" class="flex flex-wrap gap-4 justify-center">
                <SearchResultCard
                    v-for="result in paginatedResults"
                    :key="result.id"
                    :result="result"
                    class="w-full md:w-1/3 px-4 mb-4"
                />
            </div>
        </div>
    </div>
</template>

<script>
import SearchResultCard from "@/Components/Search/SearchResultCard.vue";

export default {
    components: {
        SearchResultCard,
    },
    props: {
        searchResults: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            itemsPerPage: 4,
            currentPage: 1,
            isLoading: false,
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.searchResults.length / this.itemsPerPage);
        },
        paginatedResults() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.searchResults.slice(start, end);
        },
    },
    watch: {
        searchResults() {
            this.currentPage = 1;
        },
    },
    methods: {
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
    },
};
</script>
