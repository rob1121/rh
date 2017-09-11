const fetchUsers = function() {
    this.$http.get(laroute.route("api.users.index")).then(
        response => this.$store.commit("SET_USERS", response.data),
        error    => console.log(error.data)
    );
};

/* clear user input field */
const clearUser = function() { this.$store.commit("CLEAR_USER"); };

/* fill input field with selected user */
const setSelectedUser = function(user) { this.$store.commit("SET_SELECTED_USER", user); };

/* update selected user database */
const updateUser = function() {
    const data = _.merge(this.selectedUser.data, this.password);
    this.$http.put(laroute.route("api.users.update", {user: this.selectedUser.data.id}), data )
    .then( () => {
        this.$store.commit("UPDATE_USER");
        this.$store.commit("CLEAR_USER");
        $('#modal-form').modal('hide');
    }, error => this.$store.commit("SET_ERRORS", error.data) );
};

/* add user in users list from database and from state */
const addUser = function() {
    const data = _.merge(this.selectedUser.data, this.password);

    this.$http.post(laroute.route("api.users.store"), data )
        .then( response => {
            this.$store.commit("ADD_USER", response.data);
            this.$store.commit("CLEAR_USER");
            $('#modal-form').modal('hide');
        }, error => this.$store.commit("SET_ERRORS", error.data) );
};

/* delete user from database and from state */
const deleteUser = function(user) {
    if (confirm("this will remove from the database permanently. Are you sure?"))
        this.$http.delete(laroute.route("api.users.delete", {user: user.id})).then(
            ()    => this.$store.commit("DELETE_USER", user),
            error => console.log(error.data)
        );
};


/* computed property search filter */
const filteredUsers = function() {
    this.users = _.sortBy(this.users, ['position']);

    return this.searchKey.length > 0
        ? _.filter(this.users, user => {
        return user.employee_id.toLowerCase().includes(this.searchKey.toLowerCase())
            || user.name.toLowerCase().includes(this.searchKey.toLowerCase())
            || user.email.toLowerCase().includes(this.searchKey.toLowerCase());
    })
        : this.users;
};

export {
    fetchUsers, updateUser, setSelectedUser, clearUser, deleteUser, addUser, filteredUsers
};