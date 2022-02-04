<template>
    <div>
        <div
            class="d-flex align-center"
        >
            <div>
                <span>
                    <v-icon
                        v-for="r in formattedRating"
                        :key="r"
                        color="#f8e825"
                    >
                        {{ (r <= rating) ? 'mdi-star' : 'mdi-star-half' }}
                    </v-icon>
                </span>
            </div>

            <div>
                <span>{{ text && text }} reviews</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Rating',

    props: {
        rating: {type: Number},
        text: {type: Number}
    },

    computed: {
        formattedRating() {
            return Math.round(this.rating)
        }
    }
}
</script>
