const state = {
    users: {},
    selectedUser: {
        data: {
            is_admin: false
        },
        index: -1
    },
    password: {
        password: "",
        old_password: "",
        password_confirmation: ""
    },
    errors: {}
};

const mutations = {
    SET_USERS: (state, users) => {
        state.users = users;
    },

    SET_ERRORS: (state, errors) => {
        state.errors = errors;
    },

    SET_SELECTED_USER: (state, user) => {
        var index = _.indexOf(state.users, user);

        state.selectedUser.data = JSON.parse(JSON.stringify(user));
        state.selectedUser.index = index;
        state.errors = {};
    },

    ADD_USER: (state, user) => {
        state.users.push(user);
    },

    UPDATE_USER: (state) => {
        state.users[state.selectedUser.index] = state.selectedUser.data;
    },

    CLEAR_USER: (state) => {
        state.selectedUser.data = {
            is_admin: false // use to reset toggled checkbox in the DOM
        };

        //reset input password
        state.password =  {
            password: "",
            old_password: "",
            password_confirmation: ""
        };
        state.selectedUser.index = -1;
        state.errors = {};
    },

    DELETE_USER: (state, user) => {
        var index = _.indexOf(state.users, user);
        state.users.splice(index, 1);
    }
};

export default {
    state, mutations
};