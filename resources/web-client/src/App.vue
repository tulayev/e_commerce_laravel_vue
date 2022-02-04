<template>
    <div id="app">
        <v-app>
            <Header />

            <v-main>
                <v-container>
                    <router-view/>
                </v-container>
            </v-main>

            <Footer />
        </v-app>
    </div>
</template>
<script>
import Footer from './components/Footer'
import Header from './components/Header'

export default {
    components: {Header, Footer}
}
</script>

<style>
    .v-application a {
        text-decoration: none;
    }
</style>