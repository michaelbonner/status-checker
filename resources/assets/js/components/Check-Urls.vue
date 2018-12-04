<template>
	<div>
		<div class="row">
			<button class="btn btn-success" @click.prevent="toggleSuccessful( true )" v-if="!hideSuccessful">Hide Successful</button>
			<button class="btn btn-warning" @click.prevent="toggleSuccessful( false )" v-else>Show Successful</button>
		</div>
		<check-url v-for="(url, index) in urls_array" :key="index" :url="url" :hideSuccessful="hideSuccessful"></check-url>
	</div>
</template>

<script>
	export default {
		props: ['urls'],
		computed: {
			urls_array: function(){
				return JSON.parse( this.urls )
			}
		},
		data: function(){
			return {
				hideSuccessful: false,
			}
		},
		methods: {
			toggleSuccessful: function( toggle ){
				if( toggle ){
					this.hideSuccessful = true;
					this.$emit( 'hide-successful' );
				} else {
					this.hideSuccessful = false;
					this.$emit( 'show-successful' );
				}
			}
		},
		events: {}
	}
</script>

<style>
	.flex-center {
		display: inherit;
		margin: 20px auto;
		width: 60%;
	}
	.btn {
		margin: 0 0 20px;
	}
	.url-check {
		padding: 5px;
		margin-bottom: 2px;
	}
		.url-check a {
			color: #333;
		}
	.url-check-pending {
		border: thin solid white;
	}
	.url-check-invalid {
		background: #e3e3e3;
		border: thin solid #ccc;
	}
	.url-check-success {
		background: rgb(178, 237, 171);
		border: thin solid rgb(91, 184, 86);
	}
	.url-check-fail {
		background: rgb(237, 171, 171);
		border: thin solid rgb(184, 85, 85);
	}
</style>
