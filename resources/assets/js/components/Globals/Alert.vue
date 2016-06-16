<template>
	<div class="alert alert-{{ type }}"> 
		<strong v-if="title" v-text="title"></strong> 
		<slot></slot>
	</div>
</template>

<script>
	export default {
		props: {
			type: {
				type: String,
				default: 'info'
			},
			title: {
				type: String
			}
		}
	}
</script>