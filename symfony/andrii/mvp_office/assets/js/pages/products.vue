<template>
    <h1>Hello {{ firstName }} ! Is this cooler </h1>
</template>

<script>
export default {
    name: 'Products', // for debugging
    data() {
        return {
            firstName: 'Andrii',
        };
    },
};
</script>

<style scoped>

</style>
