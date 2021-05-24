<template>
    <div class="row">
        <div class="col-12">
            <div class="mt-4">
                <loading v-show="products.length == 0"/>
            </div>
        </div>

        <product-card
            v-for="product in products"
            v-show="products.length > 0"
            :key="product['@id']"
            :product="product"
        />
    </div>
</template>

<script>
import Loading from 'mvp_office_js/components/loading';
import ProductCard from 'mvp_office_js/components/product_list/product_card';

export default {
    name: 'ProductList',
    components: {
        ProductCard,
        Loading,
    },
    props: {
        products: {
            type: Array,
            required: true,
        },
    },
};
</script>
