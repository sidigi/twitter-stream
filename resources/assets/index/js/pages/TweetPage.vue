<template>
  <div style="height: 100%; width: 100%">
    <div style="height: 100%; width: 100%" class="app-wrapper">
      <div class="row">
        <div class="col-md-12" v-if="param == '1'">
          <div class="text-center" v-if="sponsor.logo">
            <h1>
              Twitter stream <b v-text="title"></b> Sponsored by
              <img :src="sponsor.logo" alt="" height="80px" />
            </h1>
          </div>
        </div>
        <div class="col-md-12" v-else-if="param == '2'">
          <div class="box">
            <div class="item1">
              <h1>Twitter stream <b v-text="title"></b></h1>
            </div>
            <div class="item2" v-if="sponsor.logo">
              <div class="text-left" style="font-size: 14px">Sponsored by</div>
              <img
                v-if="sponsor.logo"
                :src="sponsor.logo"
                alt=""
                height="60px"
              />
            </div>
          </div>
        </div>
        <div class="col-md-12" v-else>
          <div class="text-center">
            <h1>Twitter stream <b v-text="title"></b></h1>
          </div>
        </div>
      </div>

      <tweet-list></tweet-list>
    </div>
  </div>
</template>

<script>
import TweetList from "../components/TweetList";

export default {
  props: {
    title: String,
    sponsor: Object,
  },

  data() {
    return {
      param: 2,
    };
  },

  components: {
    TweetList,
  },
};
</script>

<style>
.box {
  display: flex;
  justify-content: center;
  padding: 15px;
}
.item1 {
  flex: 1;
  display: flex;
  justify-content: center;
  transform: translateX(10px); /*D element Width[if needed]*/
}
</style>
