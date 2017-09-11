const state = {
    configuration: []
};

const mutations = {
    SET_CONFIGURATION: (state, config) => {
        state.configuration = config
    }
};

export default {
    state, mutations
};