<template>
    <section id="home-banner-box" class="home-banner loading">
        <div class="image video-slide">
            <div class="video-background">
                <div class="video-foreground" id="video-player"></div>
            </div>
        </div>
    </section>
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
                    loop: 1,
                    fs: 0,
                    rel: 0,
                    enablejsapi: 1
                },
                events: {
                    onReady: function(e) {
                        e.target.mute();
                        e.target.setPlaybackQuality('hd1080');
                        window.youtubeAPILoaded = true;
                    },
                    onStateChange: function(e) {
                        if(e && e.data === 1){
                            var videoHolder = document.getElementById('home-banner-box');
                            if(videoHolder && videoHolder.id){
                                videoHolder.classList.remove('loading');
                            }
                        }else if(e && e.data === 0){
                            e.target.playVideo()
                        }
                    }
                }
            });
        };
    }

    export default {
        props: ['videoId'],

        data: function(){
            return {
                video: null,
                interval: null
            }
        },

        mounted(){
            this.video = this.videoId;
        },

        watch: {
            video(){
                youTubeSetup();

                clearTimeout(this.interval);

                if (! window.youtubeAPILoaded){
                    this.interval = setTimeout(() => {
                        window.player.loadVideoById(this.video);
                        window.player.stopVideo();
                        window.player.playVideo();
                    }, 2000);

                    return;
                }

                window.player.loadVideoById(this.video);
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