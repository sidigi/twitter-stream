<template>
    <div></div>
</template>
<script>
    function youTubeSetup() {
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        window.onYouTubeIframeAPIReady = () => {
            window.player = new YT.Player('video-player', {
                width: 1280,
                height: 720,
                playerVars: {
                    mute: 1,
                    autohide: 1,
                    disablekb: 1,
                    controls: 0,
                    showinfo: 0,
                    modestbranding: 1,
                    fs: 0,
                    rel: 0,
                    enablejsapi: 1
                },
                events: {
                    onReady: function(e) {
                        e.target.mute();
                        e.target.setPlaybackQuality('hd1080');
                    },
                    onStateChange: function(e) {
                        if(e && e.data === 1){
                            var videoHolder = document.getElementById('home-banner-box');
                            if(videoHolder && videoHolder.id){
                                videoHolder.classList.remove('loading');
                            }
                        }else if(e && e.data === 0){
                            e.target.playVideo() //loop
                        }
                    }
                }
            });
        };
    }

    export default {
        props: ['videoId', 'videoMode'],

        data: function(){
            return {
                video: null,
                mode: 'play',
                interval: null
            }
        },

        mounted(){
            this.video = this.videoId;
            this.mode = this.videoMode;
        },

        watch: {
            mode(){

            },

            video(){
                youTubeSetup();

                if (window.player){
                    window.player.stopVideo();
                    window.player.loadVideoById(this.video);
                    window.player.playVideo();

                    return;
                }

                this.interval = setTimeout(() => {
                    window.player.stopVideo();
                    window.player.loadVideoById(this.video);
                }, 2000);
            }
        },
    }
</script>

<style>
    .home-banner .slide .video-slide {
        background-color: #000;
    }

    .home-banner.loading .video-background {
        opacity: 0;
    }

    .video-background {
        position: fixed;
        top: 50%;
        left: 0;
        padding-top: 56.25%;
        width: 100%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        -webkit-transition: 2s opacity ease;
        transition: 2s opacity ease;
        opacity: 1; }

    .video-foreground,
    .video-background iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }
</style>