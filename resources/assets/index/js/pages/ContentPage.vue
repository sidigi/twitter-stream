<template>
    <div>
        <template v-for="(item) in items">
            <background-image v-if="isImage(item)"
                v-show="isShow(item)"
                :key="item.src"
                :src="item.src"
            ></background-image>
            <background-video v-if="isVideo(item)"
                v-show="isShow(item)"
                :key="item.id"
                :video-id="item.id"
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
            this.$store.dispatch('content/getItems');
            this.$store.dispatch('content/expectItems');
        },

        computed: {
            items(){
                return this.$store.getters['content/items'];
            }
        },

        methods: {
            isImage(item){
                return item.type === 'image'
            },
            isVideo(item){
                return item.type === 'video'
            },
            isShow(item){
                return item.show;
            }
        }
    }
</script>

<style>

</style>