const state = {
    disableSorting: true,
    positionSortingLoadingState: false
};

const mutations = {
    TOGGLE_SORT_POSITION: (state) => {
        state.disableSorting = ! state.disableSorting;
    },

    TOGGLE_POSITION_SORTING_LOADING_STATE: (state) => {
        state.positionSortingLoadingState = ! state.positionSortingLoadingState;
    }
};

export default {
    state, mutations
};