const state = {
    to: '',
    from: ''
};

const mutations = {
    SET_DATE_TO: (state, dateValue) => {
        state.to = dateValue;
    },

    SET_DATE_FROM: (state, dateValue) => {
        state.from = dateValue;
    }
};

export default {
    state, mutations
};