<template>
	<div class="flex-group">
		<label class="caption">{{ name }}:</label>
		<input type="text" v-model="input" class="text">
	</div>
</template>

<style lang="stylus">
$border-hover = #4F86C6
.flex-group
	display: flex
	flex-direction: column
	margin: 5px 15px

.caption
	color: white
	text-transform: capitalize
	font-weight: bold

.text
	border-radius: 5px
	padding: 10px
	border: 1px solid #fff
	transition: .3s ease-in-out

</style>
<script>
	export default {
		props: ['input','name']
	}
</script>