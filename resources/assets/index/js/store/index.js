import tweets from './modules/tweets';
import images from './modules/images';

import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        tweets,
        images
    },

    state: {
        mode: null,
        timeoutUpdate: 5,
        expectInterval: null
    },

    getters: {
        mode: state => {
            return state.mode
        },
        timeoutUpdate: state => {
            return state.timeoutUpdate
        }
    },
    mutations: {
        setMode (state, mode) {
            state.mode = mode
        },
        setExpectInterval (state, interval){
            if (state.expectInterval){
                clearInterval(state.expectInterval);
            }
            state.expectInterval = interval
        }
    },
    actions: {
        getConfig(context){
            axios.get(`/api/config`)
                .then(res => {
                    const mode = res.data.data.mode;

                    if (context.state.mode && context.state.mode !== mode){
                        context.dispatch('tweets/clearInterval');
                        context.dispatch('images/clearInterval');
                    }

                    context.commit('setMode', mode);
            })
        },
        expectConfig(context){
            setInterval(() => {
                context.dispatch('getConfig');
            }, context.state.timeoutUpdate * 1000);
        }
    },
});