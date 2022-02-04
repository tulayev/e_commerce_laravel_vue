<template>
    <div>
        <v-app-bar
            app
            dense
        >
            <div>
                <v-toolbar-title>
                    <router-link :to="{name: 'home'}">E Commerce</router-link>
                </v-toolbar-title>
            </div>

            <v-spacer></v-spacer>

            <div
                class="header__links"
            >
                <ul>
                    <li>
                        <router-link :to="{name: 'cart'}">Cart</router-link>
                    </li>
                    <li>
                        <router-link to="/login">Login</router-link>
                    </li>
                </ul>
            </div>
        </v-app-bar>
    </div>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style>

header .header__links > ul {
    display: flex;
    list-style-type: none;
}
.header__links > ul > li {
    margin-left: 10px;
    margin-right: 10px;
}

</style>