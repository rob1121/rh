<template lang="jade">
	.table-content
		table
			thead
				th(v-for="thead in theads") {{ thead }}

			tbody(v-paginate:10="devices")
				tr(v-for="device in devices")
					td {{ device.ip }}
					td {{ device.location }}
					td
						i.fa.fa-edit edit
						span |
						i.fa.fa-trash-o delete

	ul.links
		li
			a(@click="prevDevicesPage()" href="#")
				.btn <

		li(v-for="deviceLink in devicesLinks")
			a(@click="changeDevicesPage(deviceLink)" href="#")
				.btn(:class="{active: currentDevicesPage == deviceLink}") {{ deviceLink }}

		li
			a(@click="nextDevicesPage()" href="#")
				.btn >

</template>

<style lang="stylus">
$color = #52616a
$border = #52616a
$border-hover = #AACD6E

table
    border-collapse: collapse

th, td
    border: 1px solid lighten($color, 80%)

th
	text-align: center
	background-color: lighten($border-hover, 80%)
	color: $color
	text-transform: capitalize
	font-size: 24px

td
	padding: 5px 25px
	color: $color
	text-transform: capitalize

	&:first-child
		text-align: right

.table-content
	min-height: 330px
	background-color: #fff
	box-shadow: 0px 2px 5px 2px #333
	padding: 3px
	border-radius: 5px

	table
		width: 500px

		th:first-child, td:first-child
			max-width: 100px
			min-width: 100px

		th:nth-child(2), td:nth-child(2)
			max-width: 250px
			min-width: 250px

		th:last-child, td:last-child
			text-align: center
			max-width: 150px
			min-width: 150px


.links
	display: flex
	flex-wrap: wrap
	justify-content: center

	li
		margin: 30px 5px
		list-style: none

		a
			color: lighten($color, 30%)
			font-weight: bold
			text-decoration: none

			.btn
				background-color: #fff
				display: flex
				justify-content: center
				align-items: center
				border: 1px solid lighten($border, 30%)
				border-radius: 50%
				width: 40px
				height: 40px
				transition: all .1s ease-in-out
				box-shadow: 0px 1px 3px 0px lighten($border, 30%)

				&:hover
					box-shadow: 0px 0px 0px 3px lighten($border-hover, 30%)
					color: $color
					transform: scale(1.1)
					border: 1px solid $border-hover

				&.active
					box-shadow: 0px 0px 0px 3px lighten($border-hover, 30%)
					color: $color
					transform: scale(1.1)
					border: 1px solid $border-hover
</style>

<script>

	export default {
		data() {
			return {
				theads: ['IP','location','actions']
			}
		},

		props: ['devices']
	}

</script>