<template>
    <div style="height: 100%; width: 100%">
        <div style="height: 100%; width: 100%" class="app-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1>Twitter stream <b>#PRCRussiaCIS2018</b></h1>
                    </div>
                </div>
            </div>

            <tweet-list></tweet-list>

        </div>
    </div>
</template>

<script>
    import TweetList from '../components/TweetList'

    export default {
        components: {
            TweetList
        }
    }
</script>

<style>

</style>