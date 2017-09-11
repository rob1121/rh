const state = {
    devices: {},
    selectedDevice: {
        data: {},
        index: -1
    },
    devices_placeholder: null,
    errors: {}
};

const mutations = {
    SET_DEVICES: (state, devices) => {
        const mappedDevices = _.map(devices, o => {o.position = parseInt(o.position); return o} );
        state.devices = _.sortBy(mappedDevices, ['position']);
    },

    SET_DEVICES_MEASUREMENT: (state, data) => {
        if(data.measurement.will_display_failed_omega) {
            state.devices[data.index].measurement = data.measurement
        } else {
            if(data.measurement.humidity !== "offline" && data.measurement.temperature !== "offline")
                state.devices[data.index].measurement = data.measurement
        }
    },

    DEVICES_TO_PLACEHOLDER: (state) => {
        state.devices_placeholder = JSON.parse(JSON.stringify(state.devices));
    },

    SET_ERRORS: (state, errors) => {
        state.errors = errors;
    },

    SET_SELECTED_DEVICE: (state, device) => {
        var index = _.indexOf(state.devices, device);

        state.selectedDevice.data = JSON.parse(JSON.stringify(device));
        state.selectedDevice.index = index;
    },

    // SET_DEVICE_POSITION: (state, position) => {
    //     const index = _.findIndex(state.devices, o => o.position === position);
    //     state.devices[index].position = parseInt(position);
    // },

    ADD_DEVICE: (state, device) => {
        state.devices.push(device);
    },

    UPDATE_DEVICE: (state) => {
        state.devices[state.selectedDevice.index] = JSON.parse(JSON.stringify(state.selectedDevice.data));
    },

    CLEAR_DEVICE: (state) => {
        state.selectedDevice.data = {};
        state.selectedDevice.index = -1;
        state.errors = {};
    },

    DELETE_DEVICE: (state, device) => {
        var index = _.indexOf(state.devices, device);
        state.devices.splice(index, 1);
    }
};

export default {
    state, mutations
};