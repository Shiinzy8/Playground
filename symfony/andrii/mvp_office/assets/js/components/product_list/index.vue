<template>
    <div class="row">
        <product-card
            v-for="product in products"
            :key="product['@id']"
            :product="product"
        />
    </div>
</template>

<script>
import ProductCard from 'mvp_office_js/components/product_list/product_card';

export default {
    name: 'ProductList',
    components: {
        ProductCard,
    },
    props: {
        products: {
            type: Array,
            required: true,
        },
    },
};
</script>
