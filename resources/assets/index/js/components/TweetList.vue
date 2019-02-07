<template>
    <section class="tweeter-stream page-wrapper">
        <div class="container-fluid">
            <div class="tweets-masonry row" data-masonry='{"itemSelector": ".tweet-box", "horizontalOrder": "true"}'>
                <tweet
                    v-for="tweet in tweets"
                    :key="tweet.id"
                    :avatar-url="tweet.avatar_url"
                    :user-name="tweet.user_name"
                    :created-at="tweet.created_at"
                    :media="tweet.media"
                    :text="tweet.text"
                ></tweet>
            </div>
        </div>
    </section>
</template>

<script>
    import Tweet from './Tweet'

    export default {
        components:{
            Tweet
        },

        mounted () {
            this.$store.dispatch('tweets/getItems');
            this.$store.dispatch('tweets/expectItems');
        },

        computed: {
            tweets(){
                this.$nextTick(() => {
                    new Masonry('.tweets-masonry', {
                        itemSelector: '.tweet-box'
                    });
                });

                return this.$store.getters['tweets/items'];
            }
        },
    }
</script>

<style>

</style>