<template>
    <div>
        <input
            v-model="searchTerm"
            type="search"
            placeholder="Search Products..."
            class="form-control"
            @input="onInput"
        >
    </div>
</template>

<script>
export default {
    name: 'SearchBar',
    data() {
        return {
            searchTerm: '',
        };
    },
    methods: {
        onInput() {
            this.$emit('search-products', { term: this.searchTerm });
        },
    },
};
</script>
