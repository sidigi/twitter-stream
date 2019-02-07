export default {
    namespaced: true,
    state: {
        items: [],
        expectInterval: null,
        timeOutUpdate: 5000
    },
    getters: {
        items: state => {
            return state.items
        }
    },
    mutations: {
        setItems (state, items) {
            state.items = items;
        },
        setExpectInterval (state, interval){
            if (state.expectInterval){
                clearInterval(state.expectInterval);
            }
            state.expectInterval = interval
        }
    },
    actions: {
        getItems(context){
            axios.get(`/api/images`)
                .then(res => {
                    context.commit('setItems', res.data.data);
                })
        },
        expectItems(context){
            const interval = setInterval(() => {
                context.dispatch('getItems');
            }, context.state.timeoutUpdate || 5000);

            context.commit('setExpectInterval', interval);
        },
        clearInterval(context){
            context.commit('setExpectInterval', null);
        }
    },
};