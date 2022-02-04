<template>
    <div>
        <v-footer
            app
            justify="center"
        >
            <v-container>
                <p class="footer-copyright">Copyright &copy;</p>
            </v-container>
        </v-footer>
    </div>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style>

footer {
    justify-content: center;
}
.v-application p {
    margin: 0;
}

</style>