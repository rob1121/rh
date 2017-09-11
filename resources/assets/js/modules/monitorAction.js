/**
 * get all devices from database
 * @route api.devices
 */
const getDevices = function() {
    this.$http.get(laroute.route("api.devices")).then(
        ({data}) => {
            this.$store.commit("SET_DEVICES", data.devices);
            _.map(this.devices, (d) => this.getReading(d, data.configuration));
        }, error   => console.log(error.data)
    );
};

/**
 * get readings and configuration of each device
 * @param device
 * @param config
 */
const getReading = function(device, config) {
    const index = _.findIndex(this.devices, device);

    this.$http.get(laroute.route("monitor.device.measurement", {device: device.id})).then(
        ({data}) => {
            this.$store.commit("SET_DEVICES_MEASUREMENT", {index, measurement: data});

            _.delay(() => this.getReading(device, config),
                          config.refreshment_time_to_milli_second,
                          {device: device}
            );

        }, error => console.log(error.data)
    );
};

export {
    getDevices, getReading
}