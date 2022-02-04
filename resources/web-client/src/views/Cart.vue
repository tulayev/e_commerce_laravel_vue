<template>
    <div>
        <h1>Shopping Cart</h1>

        <div v-if="cart.length === 0">
            <v-alert
                color="indigo"
                dark
            >
                Your cart is empty
            </v-alert>
        </div>
        <div v-else>
            <v-row v-for="item in cart" :key="item.id">
                <v-col>
                    {{ item.name }}
                </v-col>
                <v-col>
                    ${{ item.price }}
                </v-col>
                <v-col>
                    {{ item.qty }}
                </v-col>
                <v-col>
                    <img
                        :src="getIMageUrl(item.image)"
                        :alt="item.name"
                    />
                </v-col>
                <v-col>
                    <button
                        @click="remove(item.id)"
                    >
                        Remove
                    </button>
                </v-col>
            </v-row>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';
import constants from "../helper/constants";

export default {
    name: 'Cart',

    computed: {
        ...mapGetters({
            cart: 'cart',
        })
    },

    methods: {
        remove(id) {
            this.$store.dispatch('removeFromCart', {id: id})
        },
        getIMageUrl(pic) {
            return `${constants.IMG_PATH}/${pic}`
        }
    },
}
</script>

<style scoped>
    img {
        width: 100px;
        height: 75px;
    }
</style>