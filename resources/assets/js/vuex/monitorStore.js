const state = {
    chunkRow: []
};

const mutations = {
    SET_READING:(state) => {
    if(state.devices) {
        let countPerRow = 6;
        return _.chunk(state.devices, countPerRow);
    }
}


};

export default {
    state, mutations
};