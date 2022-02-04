import axios from '../../plugins/axios'

const state = {
    productList: null,
    productSingle: null,
    loading: false
}

const getters = {
    productList: state => {
        return state.productList
    },
    productSingle: state => {
        return state.productSingle
    },
    loading: state => {
        return state.loading
    }
}

const mutations = {
    fetchStart(state) {
        state.loading = true
    },
    fetchProductSingleSuccess(state, payload) {
        state.loading = false
        state.productSingle = payload
    },
    fetchProductListSuccess(state, payload) {
        state.loading = false
        state.productList = payload
    }
}

const actions = {
    async fetchProductSingle({commit}, {id}) {
        commit('fetchStart')
        return await axios.get(`/product/${id}`)
                .then(res => {
                    (res && res.data) ?
                        commit('fetchProductSingleSuccess', res.data.product) : {}
                })
                .catch(err => {
                    console.log(err.message)
                })
    },
    async fetchProductList({commit}) {
        commit('fetchStart')
        return await axios.get('/products')
                .then(res => {
                    (res && res.data) ?
                        commit('fetchProductListSuccess', res.data.products) : {}
                })
                .catch(err => {
                    console.log(err.message)
                })
    }
}

export default {
    state,
    mutations,
    actions,
    getters
}