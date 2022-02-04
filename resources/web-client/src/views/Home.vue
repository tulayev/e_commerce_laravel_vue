<template>
    <div>
        <h1>Latest Products</h1>
        <div v-if="!loading">
            <div v-if="products != null">
                <v-row>
                    <v-col
                        cols="12"
                        sm="6"
                        md="4"
                        lg="3"
                        v-for="product in products"
                        :key="product.id"
                    >
                        <v-card
                            class="pa-2 mx-auto"
                        >
                            <Product
                                :product="product"
                            />
                        </v-card>
                    </v-col>
                </v-row>
            </div>
        </div>
        <div v-else>
            <Spinner />
        </div>
    </div>
</template>

<script>
import Product from '../components/Product'
import Spinner from '../components/extras/Spinner'
import {mapGetters} from 'vuex'

export default {
    name: 'Home',
    components: {Spinner, Product},

    computed: {
        ...mapGetters({
            products: 'productList',
            loading: 'loading'
        }),
    },

    mounted() {
        this.$store.dispatch('fetchProductList');
    }
}
</script>

<style>
</style>
