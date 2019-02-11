<template>
    <div>
        <background-image v-show="isImage()"
            :src="item.src"
        ></background-image>


        <template>
            <section id="home-banner-box" class="home-banner loading" v-show="isVideo()">
                <div class="image video-slide">
                    <div class="video-background">
                        <div class="video-foreground" id="video-player"></div>
                    </div>
                </div>
            </section>

            <background-video
                v-if="isVideo()"
                :key="item.video_id"
                :video-id="item.video_id"
                :video-mode="item.mode"
            ></background-video>
        </template>
    </div>
</template>

<script>
    import BackgroundImage from '../components/BackgroundImage'
    import BackgroundVideo from '../components/BackgroundVideo'

    export default {
        components:{
            BackgroundImage,
            BackgroundVideo
        },

        mounted () {
            this.$store.dispatch('content/getItem');
            this.$store.dispatch('content/expectItem');
        },

        computed: {
            item(){
                return this.$store.getters['content/item'];
            }
        },

        methods: {
            isImage(){
                return this.item.type === 'image'
            },
            isVideo(){
                return this.item.type === 'video'
            },
            isShow(){
                return this.item.show;
            }
        }
    }
</script>

<style>

</style>