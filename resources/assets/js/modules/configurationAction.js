/**
 * update configuration
 * AJAX request
 * @route configuration.update
 * @HTTPVerb PUT
 */
const updateConfiguration = function() {
    this.$http.put(laroute.route("configuration.update"), this.configuration).then(
        ()       => alert("configuration is now updated"),
        error    => console.log(error.data)
    );
};


export {
    updateConfiguration
}