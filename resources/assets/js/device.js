require("./bootstrap");

import { fetchDevices, updateDevice, setSelectedDevice, clearDevice, deleteDevice, addDevice, filteredDevices, setDevicesPlaceholder } from "./modules/deviceAction";
import { togglePositionSorter, revertDevicePositions, saveDevicePositions, validationInputPositions, togglePositionSortingLoadingState } from "./modules/devicePositioningAction";
import { updateConfiguration } from "./modules/configurationAction";
import store from "./vuex/store";
import { mapState } from 'vuex';
const Sortable = require('sortablejs');

const app = new Vue({
    el: '#app',
    data: {
        searchKey: ""
    },
    
    store,

    computed: {
        ...mapState({
            configuration:           state => state.configurationStore.configuration,
            to:                          state => state.excelExporterStore.to,
            from:                        state => state.excelExporterStore.from,
            devices:                     state => state.deviceStore.devices,
            selectedDevice:              state => state.deviceStore.selectedDevice,
            devices_placeholder:         state => state.deviceStore.devices_placeholder,
            errors:                      state => state.deviceStore.errors,
            disableSorting:              state => state.devicePositionStore.disableSorting,
            positionSortingLoadingState: state => state.devicePositionStore.positionSortingLoadingState
        }),

        exportLink() {
            return laroute.route("api.excel.export", {from: this.from,to:this.to});
        },

        filteredDevices,
    },

    /* as vue instance is created this will get devices data from database */
    created() {
        this.fetchDevices();
    },

    watch: {
        /* toggle sorting of devices list */
        disableSorting() {
            sortable.option("disabled", this.disableSorting);
        },
    },

    components: {
        Datepicker: require('./components/Datepicker.vue')
    },

    methods: {
        fetchDevices,
        updateDevice,
        setSelectedDevice,
        clearDevice,
        deleteDevice,
        addDevice,
        setDevicesPlaceholder,

        updateConfiguration,

        togglePositionSorter,
        revertDevicePositions,
        saveDevicePositions,
        validationInputPositions,
        togglePositionSortingLoadingState,

        /* this enable sorting of position */
        changeDevicePositions() {
            this.togglePositionSorter();
            this.setDevicesPlaceholder();
        },

        /* clear errors notification and input field prior popup of modal */
        readyModalForInsert() {
            this.clearDevice();
        },

        /* fill input field with data of selected device */
        readyModalForUpdate(device) {
            this.setSelectedDevice(device);
        },
    }
});

Array.prototype.move = function(from, to) {
    this.splice(to, 0, this.splice(from, 1)[0]);
};
/* using sortablejs library to allow list of devices to be sorted */
const sortable = Sortable.create(document.getElementById("sortable"),{
    disabled: app.disableSorting,
    onUpdate(event) {
        app.devices.move(event.oldIndex,event.newIndex);
    }
});