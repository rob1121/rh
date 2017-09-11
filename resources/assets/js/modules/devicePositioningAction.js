/* confirm saving updated position to database */
const validationInputPositions = function() {
    if(confirm("This will save changes you've made. \n Click 'ok' to proceed?")) this.saveDevicePositions();
};

/* save updated devices positions */
const saveDevicePositions = function() {
    this.togglePositionSortingLoadingState();
    const update_devices_positions = _.map(this.devices, d => {
        return {id: d.id, position: d.position};
    });

    this.$http.post(laroute.route("api.devices.update_position"), update_devices_positions)
        .then( () => {
            this.togglePositionSorter();
            alert("devices database successfully updated.")
            this.togglePositionSortingLoadingState();
        }, errors => console.log(errors.data) );
};

/* revert devices positions to its original state */
const revertDevicePositions = function() {
    if(confirm("This will revert changes you've made. \n Click 'ok' to proceed?")) {
        this.$store.commit("SET_DEVICES", this.devices_placeholder);
        this.togglePositionSorter();
    }
};

/* enable or disable position sorting  */
const togglePositionSorter = function() { this.$store.commit("TOGGLE_SORT_POSITION"); };

/* enable or disable position sorting */
const togglePositionSortingLoadingState = function() { this.$store.commit("TOGGLE_POSITION_SORTING_LOADING_STATE"); };

export { togglePositionSorter, saveDevicePositions, revertDevicePositions, validationInputPositions, togglePositionSortingLoadingState }