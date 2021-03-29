<template>
    <span class="p-3">
        {{ title }}
    </span>
</template>

<script>
export default {
    name: 'Legend',
    props: {
        title: {
            require: true,
            type: String,
            default: 'Default title',
        },
    }, // this is like arguments for a function
};
</script>
