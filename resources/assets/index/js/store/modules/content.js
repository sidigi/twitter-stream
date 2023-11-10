export default {
    namespaced: true,
    state: {
        item: [],
        expectInterval: null,
        timeOutUpdate: 5000
    },
    getters: {
        item: state => {
            return state.item
        }
    },
    mutations: {
        setItem (state, item) {
            state.item = item;
        },
        setExpectInterval (state, interval){
            if (state.expectInterval){
                clearInterval(state.expectInterval);
            }
            state.expectInterval = interval
        }
    },
    actions: {
        getItem(context){
            axios.get(`/api/content`)
                .then(res => {
                    context.commit('setItem', res.data.data);
                })
        },
        expectItem(context){
            const interval = setInterval(() => {
                context.dispatch('getItem');
            }, context.state.timeoutUpdate || 5000);

            context.commit('setExpectInterval', interval);
        },
        clearInterval(context){
            context.commit('setExpectInterval', null);
        }
    },
};