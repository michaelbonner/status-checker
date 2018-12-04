<template>
	<div :class="className" v-if="visible">
		<table>
			<tr>
				<td>
					<a :href="url" target="_blank">{{ url }}</a>
				</td>
				<td>
					{{ status }}
				</td>
				<td v-if="hasReredirectPath">
					<a v-on:click="toggleRedirectPath()">
						Redirected {{ redirectPath.length - 1 }} time(s)
					</a>
				</td>
			</tr>
		</table>
		<span v-if="redirectPathVisible" style="text-align: left">
			<h4>Redirect Path:</h4>
			<ul>
				<li v-for="path in redirectPath">
					{{ path }}
				</li>
			</ul>
		</span>
	</div>
</template>

<script>
	export default {
		mounted() {
			this.testUrl();
		},
		props: ['url','hideSuccessful'],
		watch: {
			hideSuccessful: function(){
				this.hideOrShow();
			},
			status: function(){
				this.hideOrShow();
			}
		},
		data: function(){
			return {
				status: '',
				http_response: '',
				className: 'url-check url-check-pending',
				visible: true,
				hasReredirectPath: false,
				redirectPathVisible: false
			}
		},
		methods: {
			testUrl(){
				if( this.url.substring( 0, 4 ) != 'http' ){
					this.status = ' is not a valid url';
					this.success = false;
					this.className = 'url-check url-check-invalid';
				} else {
					this.axios.post( '/check_status', { url: this.url } ).then( ( response ) => {
						this.http_response = response.data;
						this.status = this.http_response.status_code;
						this.success = this.http_response.status_code == 200 ? true : false;
						this.className = this.http_response.status_code == 200 ? 'url-check url-check-success' : 'url-check url-check-fail';
						this.redirectPath = this.http_response.redirect_path;
						this.hasReredirectPath = this.redirectPath.length > 1;

					}, ( response ) => {
						// error callback
						this.http_response = response.data;
						this.status = this.http_response.status_code;
						this.success = this.http_response.status_code == 200 ? true : false;
						this.className = this.http_response.status_code == 200 ? 'url-check url-check-success' : 'url-check url-check-fail';
						this.redirectPath = this.http_response.redirect_path;
						this.hasReredirectPath = this.redirectPath.length > 1;
					});
				}
			},
			hideOrShow(){
				if( this.hideSuccessful && this.success ) {
					this.visible = false;
				} else {
					this.visible = true;
				}
			},
			toggleRedirectPath(){
				this.redirectPathVisible = ! this.redirectPathVisible;
			}
		}
	}
</script>

<style lang="scss" scoped>
	table {
		margin: 0 auto;
		td {
			padding: 0 10px;
			border-left: thin solid #333;

			&:first-child {
				border-left: none;
			}
		}
	}
</style>
