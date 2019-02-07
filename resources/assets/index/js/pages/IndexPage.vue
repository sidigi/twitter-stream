<template>
    <div>
        <tweet-page
            v-if="isTweetMode"
        ></tweet-page>
        <image-page
            v-if="isImageMode"
        ></image-page>
    </div>
</template>

<script>
    export default {
        mounted () {
            this.$store.dispatch('getConfig');
            this.$store.dispatch('expectConfig');
        },

        computed: {
            mode () {
                return this.$store.getters.mode;
            },
            isTweetMode () {
                return this.$store.getters.mode === 'tweets';
            },
            isImageMode () {
                return this.$store.getters.mode === 'images';
            },
        },
    }
</script>

<style>

</style>