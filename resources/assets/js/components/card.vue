<template lang="jade">
	.box
		#title
			slot
			p.dateTime {{ time }}

		.cards
			.card(v-for="device in omegas | isOne" v-bind:class="device  | filterClasses")
				.card-loader(v-show="device.is_recording != 'Off' && device.is_recording != 'On'")
					span Fetching data..
					pulse-loader(loading="loading" color="#ffffff" size="15px")

				.title  {{ device.location }}:

				.content
					.card-content
						.name RH:
						.value {{ device.rh | isNull | isUndefined | suffix "%"}}

					.card-content
						.name TEMP:
						.value {{ device.temp | isNull | isUndefined | suffix "&deg;C"}}

				.card-footer
					p recording: {{ device.is_recording | isNull | isUndefined }}

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
	animation: shake .82s cubic-bezier(.36,.07,.19,.97) both 1s
	transform: translate3d(0, 0, 0)

	.content .card-content .name
		color: $label-red

	.card-footer
		color: $label-red

.dateTime
	color: $red
	font-size: 14px

.box
	overflow: hidden

#title
	color: #222
	text-shadow: 1px 1px 3px lighten($label-green, 50%)
	text-align: center
	font-weight: bold
	font-size: 24px
	margin-bottom: 24px

.cards
	animation: slideup 1s ease-in-out
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


.card-loader
	background: linear-gradient(to bottom right, #353866, lighten(#353866, 50%))
	display: flex
	flex-direction: column
	color: #fff
	font-weight: bold
	justify-content: center
	align-items: center
	position: absolute
	z-index: 1
	width:180px
	height: 180px
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
	font-size: 20px

	div
		width: 100%
		flex-grow: 1
		font-weight: bold

	.name
		color: $label-green
		padding-right: 10px
		text-align: right

	.value
		transition: all 1s ease-in-out
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

@keyframes slideup
	from
		transform: translateY(30px)
		opacity: 0

	to
		transform: translateY(0px)
		opacity: 1

@keyframes shake
	10%, 90%
		transform: translate3d(-1px, 0, 0)


	20%, 80%
		transform: translate3d(2px, 0, 0)


	30%, 50%, 70%
		transform: translate3d(-4px, 0, 0)


	40%, 60%
		transform: translate3d(4px, 0, 0)


	50%
		box-shadow: 0px 5px 10px 0px  $border-green


	100%
		box-shadow: 0px 2px 5px 0px  $border-green
</style>

<script>
import { PulseLoader  } from 'vue-spinner/dist/vue-spinner.min.js';

	export default {

		data(){
			return {
				alert: 'alert-green'
			}
		},

		components: { PulseLoader },

		props: ['omegas', 'time'],

		filters: {
			filterClasses(Obj) {
				return this.status(Obj.rh, Obj.temp, Obj.is_recording);
			},

            isUndefined( value ) {
                if(typeof value == "undefined" ) return "Offline";

                return value;
            },

            isNull( value ) {
                if( value === null ) return "Offline";

                return value;
            },

            suffix( value , suffix ) {
                if( value == 'Offline' ) return "Offline";

                return `${value} ${suffix}`;
            },

            isOne(omegas) {
            	return ! omegas.length ? [omegas] : omegas;
            }
		},

		methods: {
	        status(rh, temp, is_recording) {
	            var alert = "";

		        if ( typeof temp == "undefined"
                        || typeof rh == "undefined"
                        || temp == "Offline"
                        || rh == "Offline"
                )
		            if(is_recording == "Off") alert = 'alert-red'; //originally alert-red

		        else
		        {
		            alert = temp > 25.6 || temp < 19.5 || rh > 55.6 || rh < 44.5
		            	? 'alert-red' //originally alert-red
		            	: 'alert-green';
		        }

		        return alert;
	        }
		}
	}
</script>