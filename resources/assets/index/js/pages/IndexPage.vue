<template>
    <div>
        <tweet-page
            v-if="isTweetMode"
            :title="title"
            :sponsor="sponsor"
        ></tweet-page>
        <content-page
            v-if="isContentMode"
        ></content-page>
    </div>
</template>

<script>
    var isModeChange = false;

    export default {
        props: {
            title: String,
            sponsor: Object
        },

        mounted () {
            this.$store.dispatch('getConfig');
            this.$store.dispatch('expectConfig');
        },

        watch: {
          mode(){
              if (isModeChange){
                  location.reload();
              }

              isModeChange = true;
          }
        },

        computed: {
            mode () {
                return this.$store.getters.mode;
            },
            isTweetMode () {
                return this.mode === 'tweets';
            },
            isContentMode () {
                return this.mode === 'content';
            }
        },
    }
</script>

<style>

</style>