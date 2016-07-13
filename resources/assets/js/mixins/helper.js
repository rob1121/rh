export default {
	methods: {
		helperFindIndex(array, key, lookup) {
			return array.findIndex(function(item) {
				return item[key] == lookup;
			});
		},

		helperMakeNonReactive(collection) {
			return JSON.parse(JSON.stringify(collection));
		}
	}
}