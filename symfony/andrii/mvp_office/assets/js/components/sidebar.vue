<template>
    <div :class="[this.$style.component, 'p-3', 'mb-5']">
        <div v-show="!collapsed">
            <h5 class="text-center">
                Categories
            </h5>
            <loading v-show="loading" />
            <ul class="nav flex-column mb4">
                <li class="nav-item">
                    <a
                        :class="{'nav-link': true, 'selected': currentCategoryId === null,}"
                        href="/"
                    >
                        All Products
                    </a>
                </li>
                <li
                    v-for="(category) in categories"
                    :key="category['@id']"
                    class="nav-item"
                >
                    <a
                        :class="{'nav-link': true, 'selected': category['@id'] === currentCategoryId,}"
                        :href="`/andrii/mvp_office/category/${category.id}`"
                    >
                        {{ category.name }}
                    </a>
                </li>
            </ul>

            <hr>
        </div>
        <div class="d-flex justify-content-end">
            <button
                class="btn btn-secondary btn-sm"
                @click="$emit('toggle-collapsed')"
                v-text="collapsed ? '>>' : '<< Collapse'"
            />
        </div>
    </div>
</template>

<script>
import Loading from 'mvp_office_js/components/loading';
import { fetchCategories } from 'mvp_office_js/services/categories_service';

export default {
    name: 'Sidebar',
    components: {
        Loading,
    },
    props: {
        collapsed: {
            type: Boolean,
            required: true,
        },
        currentCategoryId: {
            type: String,
            default: null,
        },
    },
    data() {
        return {
            categories: [],
        };
    },
    computed: {
        loading() {
            return this.categories.length === 0;
            // if there are no categories that means we are loading data
        },
    },
    async created() {
        const response = await fetchCategories(); // need to add async to mounted
        this.categories = response.data['hydra:member'];
    },
};

</script>

<style lang="scss" module>
@import '~mvp_office_scss/components/light-component.scss';

.component :global {
    @include light-component;

    ul {
        li a:hover {
            background: $blue-component-link-hover;
        }

        li a.selected {
            background: $light-component-border;
        }

        li a.selected {
            background: $light-component-border;
        }
    }
}

</style>
