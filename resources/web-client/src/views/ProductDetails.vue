<template>
    <div>
        <div v-if="!loading">
            <div
                v-if="product"
            >
                <a @click="$router.go(-1)">Back</a>

                <v-row>
                    <v-col lg="6">
                        <v-img
                            :src="getIMageUrl(product.image)"
                        >
                        </v-img>
                    </v-col>

                    <v-col lg="3">
                        <ul>
                            <li class="list-item py-4">
                                <h4>{{ product.name }}</h4>
                            </li>

                            <li class="list-item py-4">
                                <div>
                                    <Rating :rating="product.rating" :text="product.num_reviews" />
                                </div>
                            </li>

                            <li class="list-item py-4">
                                <p>
                                   Price: ${{ product.price }}
                                </p>
                            </li>

                            <li class="list-item py-4">
                                <p>
                                   Description: {{ product.description }}
                                </p>
                            </li>
                        </ul>
                    </v-col>

                    <v-col lg="3">
                        <ul>
                            <li class="list-item py-4">
                                <div class="d-flex justify-space-between px-3">
                                    <p>Price:</p>
                                    <p>${{ product.price }}</p>
                                </div>
                            </li>
                            <li class="list-item py-4">
                                <div class="d-flex justify-space-between px-3">
                                    <p>Status:</p>
                                    <p>{{ product.count_in_stock > 0 ? 'In Stock' : 'Out of stock' }}</p>
                                </div>
                            </li>
                            <li
                                v-if="product.count_in_stock > 0"
                                class="list-item py-4"
                            >
                                <div class="d-flex justify-space-between px-3">
                                    <p>Quantity:</p>
                                    <div>
                                        <select
                                            style="width: 50px;"
                                            v-model="qty"
                                        >
                                            <option
                                                v-for="i in items"
                                                :key="i"
                                                :value="i+1"
                                                class="text-center">
                                                {{ i + 1 }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="py-4">
                                <div class="d-flex justify-center">
                                    <v-btn
                                        @click="addToCartHandler"
                                        :disabled="product.count_in_stock <= 0"
                                        class="text-uppercase"
                                        color="primary"
                                        depressed
                                    >
                                        Add To Cart
                                    </v-btn>
                                </div>
                            </li>
                        </ul>
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
import Rating from '../components/extras/Rating'
import {mapGetters} from 'vuex'
import Spinner from '../components/extras/Spinner'
import constants from '../helper/constants'

export default {
    name: 'ProductDetails',
    components: {Spinner, Rating},
    data: function () {
        return {
            qty: 1
        }
    },
    computed: {
        items() {
            return [...Array(this.product.count_in_stock).keys()] // hello
        },
        ...mapGetters({
            product: 'productSingle',
            loading: 'loading'
        })
    },
    methods: {
        addToCartHandler() {
            this.$store.dispatch('addToCart', { product: this.product, qty: this.qty })
            this.$router.push(`/cart/${this.$route.params.id}?qty=${this.qty}`)
        },
        getIMageUrl(pic) {
            return `${constants.IMG_PATH}/${pic}`
        }
    },
    mounted() {
        this.$store.dispatch('fetchProductSingle', { id: this.$route.params.id })
    }
}
</script>

<style scoped>
.list-item {
    border-bottom: 1px solid #111;
}
.list-item h4 {
    font-size: 30px;
}
.list-item p {
    margin: 0;
}
</style>
