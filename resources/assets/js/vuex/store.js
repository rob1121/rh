import Vue from "vue";
import Vuex from "vuex";
import deviceStore from "./deviceStore";
import configurationStore from "./configurationStore";
import devicePositionStore from "./devicePositionStore";
import excelExporterStore from "./excelExporterStore";
import userStore from "./userStore";


Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        configurationStore,
        deviceStore,
        userStore,
        devicePositionStore,
        excelExporterStore
    },
    debug: true
});