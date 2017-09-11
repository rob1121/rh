require("./bootstrap");
import store from "./vuex/store";
import {getDevices, getReading} from "./modules/monitorAction";
import { mapState } from 'vuex';

const app = new Vue({
    el: "#app",

    data: {
        date_refreshed: Date.now()
    },

    store,

    created() {
        this.getDevices();
    },

    computed: mapState({
        devices: state => state.deviceStore.devices,

        chunkRow() {
            if(this.devices) {

                const countPerRow = 6;
                let filteredDevices = _.filter( this.devices,
                                                d => ! this.hideOfflineDevice(d) && ! this.hideDeviceOnPL3(d) );

                return _.chunk(filteredDevices, countPerRow);
            }
        }
    }),

    methods: {
        getDevices,
        getReading,

        /**
         * check omega if to hide pl3
         * @param device
         * @returns {*|boolean}
         */
        hideDeviceOnPL3(device) {
            const isLocatedInPl3 = device.location.toLowerCase().includes("pl3"),
                  shouldHidePL3  = device.measurement.hide_pl3;

            return shouldHidePL3 && isLocatedInPl3
        },

        /**
         * check omega if to hide offline
         * @param device
         * @returns {*|boolean}
         */
        hideOfflineDevice(device) {
            const isOffline         = device.measurement.humidity === "offline",
                  shouldHideOffline = device.measurement.hide_offline;

            return shouldHideOffline && isOffline;
        }
    }
});