<template>
    <div>
        <router-link :to="{ name: 'productDetails', params: { id: product.id } }">
            <v-img
                :src="getIMageUrl(product.image)"
                :alt="product.name"
            ></v-img>
        </router-link>

        <v-card-title>
            {{ product.name }}
        </v-card-title>

        <v-card-subtitle
            class="my-2"
        >
            <Rating
                :rating="product.rating"
                :text="product.num_reviews"
            />
        </v-card-subtitle>

        <v-card-text>
            ${{ product.price }}
        </v-card-text>
    </div>
</template>

<script>
import Rating from './extras/Rating'
import constants from '../helper/constants'

export default {
    name: 'Product',
    components: {Rating},
    props: {
        product: {
            type: Object
        }
    },
    methods: {
        getIMageUrl(pic) {
            return `${constants.IMG_PATH}/${pic}`
        }
    }
}
</script>

<style>

</style>