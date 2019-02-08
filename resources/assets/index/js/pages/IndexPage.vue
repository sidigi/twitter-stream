<template>
    <div>
        <tweet-page
            v-if="isTweetMode"
            :title="title"
        ></tweet-page>
        <content-page
            v-if="isContentMode"
        ></content-page>
    </div>
</template>

<script>
    export default {
        props: {
            'title': String
        },
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
            isContentMode () {
                return this.$store.getters.mode === 'content';
            }
        },
    }
</script>

<style>

</style>