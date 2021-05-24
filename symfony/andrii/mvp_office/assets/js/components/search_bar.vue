<template>
    <div>
        <input
            v-model="searchTerm"
            type="search"
            placeholder="Search Products..."
            class="form-control"
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
};
</script>
