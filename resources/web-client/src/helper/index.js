const addProduct = (cart, id = null, qty = null) => {
    if (id != null && qty != null) {
        cart = cart.map(p => p.id === id ? {...p, qty: p.qty += qty} : p)
    }

    localStorage.setItem('cart', JSON.stringify(cart))
}

const removeProduct = (cart, id) => {
    const product = cart.find(p => p.id === id)
    cart.splice(cart.indexOf(product), 1)

    localStorage.setItem('cart', JSON.stringify(cart))
}

export {addProduct, removeProduct}