<template>
    <div style="height: 100%; width: 100%">
        <div style="height: 100%; width: 100%" class="app-wrapper">
            <div class="imgbox">
                <img :src="src" alt="" class="center-fit">
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            src: String
        },
    }
</script>

<style>

</style>