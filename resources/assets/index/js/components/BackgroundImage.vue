<template>
    <div class="imgbox">
        <img v-if="image" :src="image.url" alt="" class="center-fit">
    </div>
</template>
<script>
    export default {
        mounted () {
            this.$store.dispatch('images/getItems');
            this.$store.dispatch('images/expectItems');
        },

        computed: {
            image(){
                return this.$store.getters['images/items'][0];
            }
        },
    }
</script>

<style>

</style>