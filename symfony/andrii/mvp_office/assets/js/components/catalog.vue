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
                <search-bar
                    @search-products="onSearchProducts"
                />
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
import SearchBar from 'mvp_office_js/components/search_bar';
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
            searchTerm: '',
            legend: 'Shipping takes 10-12 weeks, and products probably won\'t work',
        };
    },
    watch: {
        currentCategoryId() {
            this.loadProducts(this.searchTerm);
        },
    },
    created() {
        this.loadProducts();
    },
    methods: {
        /**
         * Handles a change in the searchTerm provided by the search bar and fetches new products
         *
         * @param {string} term
         */
        onSearchProducts({ term }) {
            this.searchTerm = term;
            this.loadProducts(this.searchTerm);
        },
        async loadProducts() {
            this.loading = true;

            let response;
            try {
                response = await fetchProducts(this.currentCategoryId, this.searchTerm);
                this.loading = false;
            } catch (e) {
                this.loading = false;

                return;
            }

            this.products = response.data['hydra:member'];
        },
    },
};
</script>
