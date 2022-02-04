import {addProduct, removeProduct} from '../../helper/index'

const state = {
    cart: []
}

const getters = {
    cart: state => {
        return state.cart
    }
}

const mutations = {}

const actions = {
    async addToCart({commit}, {product, qty}) {
        const productInCart = state.cart.find(p => p.id === product.id)

        if (!productInCart) {
            state.cart.push({
                id: product.id,
                name: product.name,
                price: product.price,
                image: product.image,
                qty: qty
            })
            addProduct(state.cart)
        } else {
            addProduct(state.cart, product.id, qty)
        }
    },
    async removeFromCart({commit}, {id}) {
        removeProduct(state.cart, id)
    }
}

export default {
    state,
    mutations,
    actions,
    getters
}