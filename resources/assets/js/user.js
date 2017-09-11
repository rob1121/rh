require("./bootstrap");
import {fetchUsers, updateUser, setSelectedUser, clearUser, deleteUser, addUser, filteredUsers } from "./modules/userAction";
import store from "./vuex/store";
import { mapState } from 'vuex';

const app = new Vue({
    el: '#app',
    data: {
        searchKey: ""
    },

    store,

    computed: mapState({
        users:                     state => state.userStore.users,
        selectedUser:              state => state.userStore.selectedUser,
        fake_reading:              state => state.configurationStore.fake_reading,
        errors:                    state => state.userStore.errors,
        password:                  state => state.userStore.password,
        filteredUsers
    }),

    created() {
        this.fetchUsers();
    },

    methods: {
        fetchUsers,
        updateUser,
        setSelectedUser,
        clearUser,
        deleteUser,
        addUser,

        /* set selected user prior insert modal popup */
        readyModalForInsert() {
            this.clearUser();
        },

        /* set selected user prior update modal popup */
        readyModalForUpdate(user) {
            this.setSelectedUser(user);
        }
    }
});