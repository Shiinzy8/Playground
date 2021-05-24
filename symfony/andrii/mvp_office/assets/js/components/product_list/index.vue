<template>
    <div class="row">
        <div class="col-12">
            <div class="mt-4">
                <loading v-show="loading"/>

                <h5 v-show="!loading && products.length === 0">
                    Whoopsite daisy, no products here!
                </h5>
            </div>
        </div>

        <product-card
            v-for="product in products"
            v-show="!loading"
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
        loading: {
            type: Boolean,
            required: true,
        },
    },
};
</script>
