<template lang="jade">


	.box
		#title
			slot
		.cards
			.card(v-for="device in omegas" v-bind:class="status(device.rh, device.temp)")

				.title  {{ device.location }}:

				.content
					.card-content
						.name RH:
						.value {{ device.rh }}

					.card-content
						.name TEMP:
						.value {{ device.temp }}

				.card-footer
					p recording: yes

</template>

<style lang="stylus">
$fade-white = rgba(255,255,255, 0.7)
$green = lighten(#75D701, 50%)
$red = firebrick
$border-green = #3B4E32

$label-green = #3B4E32
$label-red = lighten($red, 60%)

.alert-green
	background: $green

	.content .card-content .name
		color: $label-green

.alert-red
	background: $red

	.content .card-content .name
		color: $label-red

	.card-footer
		color: $label-red


#title
	color: $label-green
	text-align: center
	font-weight: bold
	font-size: 24px
	margin-bottom: 24px

.cards
	display: flex
	flex-wrap: wrap
	justify-content: space-around
	align-items: center

.card
	display: flex
	flex-direction: column
	margin: 5px 0
	width:180px
	height: 180px
	border: 1px solid $border-green
	box-shadow: 0px 2px 5px 0px $border-green

.title
	padding-left: 5px
	font-size: 14px
	margin-bottom: 20px
	text-transform: uppercase
	background: $fade-white
	font-weight: bold
	color: $border-green


.card-content
	padding: 1px 5px
	display: flex
	font-size: 24px

	div
		width: 100%
		flex-grow: 1
		font-weight: bold

	.name
		color: $label-green
		padding-right: 10px
		text-align: right

	.value
		color: $label-green
		padding-left: 2px
		background: $fade-white


.card-footer
	padding: 5px
	display: flex
	justify-content: flex-end
	flex-grow: 1
	padding-top: 15px
	font-size: 14px
	color: $label-green
	text-transform: capitalize
	align-items: flex-end
</style>

<script>
	export default {
		data( ){
			return {
				alert: 'alert-green'
			}
		},

		props: ['omegas'],

		methods: {

	        status(rh, temp) {
	            var self = this;

		        if ( temp == "Offline" || rh == "Offline" )
		        {
		            self.alert = 'alert-red';
		        }

		        else
		        {
		            self.alert = temp > 25.6
		                || temp < 19.5
		                || rh > 55.6
		                || rh < 44.5
		                ? 'alert-red'
		                : 'alert-green';
		        }

		        return self.alert;
	        }
		}

	}
</script>