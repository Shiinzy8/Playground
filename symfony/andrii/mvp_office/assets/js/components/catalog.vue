<template>
    <div>
        <div class="row">
            <div class="col-12">
                <title-component
                    :current-category-id="currentCategoryId"
                    :categories="categories"
                />
            </div>
            <div class="col-9">
                <search-bar />
            </div>
        </div>
        <product-list
            :products="products"
            :loading="loading"
        />
        <div class="row">
            <legend-component :title="legend + ' this is JavaScript'" />
        </div>
    </div>
</template>

<script>

import TitleComponent from 'mvp_office_js/components/title';
import LegendComponent from 'mvp_office_js/components/legend';
import ProductList from 'mvp_office_js/components/product_list';
import SearchBar from 'mvp_office_js/components/search_bar'
import { fetchProducts } from 'mvp_office_js/services/products_service';

export default {
    name: 'Catalog',
    components: {
        LegendComponent,
        ProductList,
        TitleComponent,
        SearchBar,
    },
    props: {
        currentCategoryId: {
            type: String,
            default: null,
        },
        categories: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            products: [],
            loading: false,
            legend: 'Shipping takes 10-12 weeks, and products probably won\'t work',
        };
    },
    // it is also can be created function
    // async mounted() {
    async created() {
        this.loading = true;

        // axios.get('/api/products').then((response) => {
        //     // then function is a promise
        //     console.log(response);
        // });
        // const response = axios.get('/api/products'); - this respnose is a promise
        // const response = await axios.get('/api/products'); // need to add async to mounted

        let response;
        try {
            response = await fetchProducts(this.currentCategoryId);
            this.loading = false;
        } catch (e) {
            this.loading = false;

            return;
        }

        // console.log(response);
        this.products = response.data['hydra:member'];
    },
};
</script>
