<template>
    <div>
        <input
            :value="searchTerm"
            type="search"
            placeholder="Search Products..."
            class="form-control"
            @input="searchTerm = $event.target.value"
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
