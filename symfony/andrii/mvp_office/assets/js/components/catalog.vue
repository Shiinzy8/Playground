<template>
    <div>
        <div class="row">
            <div class="col-12">
                <h1>
                    Products
                </h1>
            </div>
        </div>
        <product-list :products="products"/>
        <div class="row">
            <legend-component :title="legend + ' this is JavaScript'" />
        </div>
    </div>
</template>

<script>

import axios from 'axios';
import LegendComponent from 'mvp_office_js/components/legend';
import ProductList from 'mvp_office_js/components/product_list';

export default {
    name: 'Catalog',
    components: {
        LegendComponent,
        ProductList,
    },
    data() {
        return {
            products: [],
            legend: 'Shipping takes 10-12 weeks, and products probably won\'t work',
        };
    },
    async mounted() {
        // axios.get('/api/products').then((response) => {
        //     // then function is a promise
        //     console.log(response);
        // });
        // const response = axios.get('/api/products'); - this respnose is a promise
        const response = await axios.get('/api/products'); // need to add async to mounted
        // console.log(response);
        this.products = response.data['hydra:member'];
    },
};
</script>
