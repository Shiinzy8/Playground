<template>
    <div class="input-group">
        <input
            v-model="searchTerm"
            type="search"
            placeholder="Search Products..."
            class="form-control"
            @input="onInput"
        >
        <div
            v-show="searchTerm !== ''"
            class="input-group-append"
        >
            <button
                class="btn btn-outline-secondary"
                @click="eraseSearchTerm"
            >
                X
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SearchBar',
    data() {
        return {
            searchTerm: '',
            searchTimeout: null,
        };
    },
    methods: {
        onInput() {
            if (this.searchTimeout) {
                clearTimeout(this.searchTimeout);
            }

            // this an arrow function, without it this is not a Vue object
            this.searchTimeout = setTimeout(() => {
                this.$emit('search-products', { term: this.searchTerm });
                this.searchTimeout = null;
            }, 200);
        },
        eraseSearchTerm() {
            this.searchTerm = '';

            this.$emit('search-products', { term: this.searchTerm });
        },
    },
};
</script>
