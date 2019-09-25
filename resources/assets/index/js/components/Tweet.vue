<template>
    <div class="tweet-box col-md-3">
        <div class="tweet">
            <div class="tweet-header">
                <span class="tweet-icon" :style="iconStyle"></span>
                <h5 class="tweet-title">{{ userName }}</h5>
                <span class="tweet-time"> {{ humanDate }}</span>
            </div>
            <div class="tweet-body">

                <template v-for="item in media">
                    <img class="tweet-image" :src="item['media_url']" alt="" v-if="isImage(item)">

                    <video v-if="isVideo(item)" style="width:600px;max-width:100%;" autoplay="autoplay" muted loop>
                        <template v-for="video in item.video_info.variants">
                            <source :src="video.url" :type="video.content_type">
                        </template>

                        Your browser does not support HTML5 video.
                    </video>
                </template>
                <div class="tweet-message" v-html="text"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            avatarUrl : String,
            userName : String,
            createdAt : Object,
            media : Array,
            text : String,
        },

        computed: {
            iconStyle(){
                return {
                    backgroundImage : `url(${this.avatarUrl})`
                }
            },
            humanDate(){
                return moment(this.createdAt).fromNow()
            }
        },

        methods: {
            isImage(item){
                return item.type === 'photo'
            },
            isVideo(item){
                return item.type === 'video'
            }
        }
    }
</script>

<style>

</style>