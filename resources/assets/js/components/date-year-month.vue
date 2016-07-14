<template lang="jade">
	.select-group
		label(for="year") Year:
			select.text(name="year" v-model="select.year")
				option(v-for="year in years")
					{{ year }}

		label(for="month") Month:
			select.text(name="month" v-model="select.month")
				option(v-for="month in months" value="{{ month.numeric }}")
					{{ month.name }}
</template>

<style lang="stylus">
	.select-group
		padding: 5px 10px

		label
			margin-left: 5px
</style>

<script>
	export default {
		data() {
			return {
				months: [
					{ name: 'all', numeric: 0 },
					{ name: 'January', numeric: 1 },
					{ name: 'February', numeric: 2 },
					{ name: 'March', numeric: 3 },
					{ name: 'April', numeric: 4 },
					{ name: 'May', numeric: 5 },
					{ name: 'June', numeric: 6 },
					{ name: 'July', numeric: 7 },
					{ name: 'August', numeric: 8 },
					{ name: 'September', numeric: 9 },
					{ name: 'October', numeric: 10 },
					{ name: 'November', numeric: 11 },
					{ name: 'December', numeric: 12 }
				]
			}
		},

		props: ['select'],

		computed: {
			years() {

				var today = new Date(),
				    yyyy = today.getFullYear(),
				    year = [];

				for (var i = 0; i < 10; i++, yyyy--) {
				    year[i] = yyyy;
				};

				return year;
			}
		}
	}
</script>