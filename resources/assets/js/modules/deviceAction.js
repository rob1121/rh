/**
 * fetch list of devices and configurations
 */
const fetchDevices = function() {
    this.$http.get(laroute.route("api.devices"))
        .then(({data}) => {
            this.$store.commit("SET_DEVICES", data.devices);
            this.$store.commit("SET_CONFIGURATION", data.configuration);
        });
};

/* update devices database and state */
const updateDevice = function() {
    this.$http.put(laroute.route("api.devices.update", {device: this.selectedDevice.data.id}), this.selectedDevice.data )
    .then( () => {
        this.$store.commit("UPDATE_DEVICE");
        this.$store.commit("CLEAR_DEVICE");
        $('#modal-form').modal('hide');
    }, error => this.$store.commit("SET_ERRORS", error.data) );
};

/* insert new device to devices database and state */
const addDevice = function() {
    this.$http.post(laroute.route("api.devices.store"), this.selectedDevice.data )
    .then( response => {
        this.$store.commit("ADD_DEVICE", response.data);
        this.$store.commit("CLEAR_DEVICE");
        $('#modal-form').modal('hide');
    }, error => this.$store.commit("SET_ERRORS", error.data) );
};

/* delete device from devices database and from state */
const deleteDevice = function(device) {
    if (confirm("this will remove from the database permanently. Are you sure?"))
        this.$http.delete(laroute.route("api.devices.delete", {device: device.id})).then(
            () => this.$store.commit("DELETE_DEVICE", device),
            error => console.log(error.data)
        );
};

/* vue computed property for searching and sorting for devices list */
const filteredDevices = function() {
    let devices = this.devices;
    return this.searchKey.length > 0
        ? _.filter(devices, device => {
            return device.ip.toLowerCase().includes(this.searchKey.toLowerCase())
                || device.location.toLowerCase().includes(this.searchKey.toLowerCase());
        })
        : devices;
};

/* set devices temporary holder while updating positions of each device */
const setDevicesPlaceholder = function() { this.$store.commit('DEVICES_TO_PLACEHOLDER'); };

/* clear input device modal input field */
const clearDevice = function() { this.$store.commit("CLEAR_DEVICE"); };

/* set selectedData variable */
const setSelectedDevice = function(device) { this.$store.commit("SET_SELECTED_DEVICE", device); };

export {
    fetchDevices, updateDevice, setSelectedDevice, clearDevice, deleteDevice, addDevice, filteredDevices, setDevicesPlaceholder
};