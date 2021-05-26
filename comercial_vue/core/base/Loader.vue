<template>
	<div class="text-center">
    
    	<v-dialog
          style="z-index:100000"
      		v-model="dialog"
      		persistent
      		width="300">
      		<v-card
        		>
        		<v-card-text class="text-center">
         			{{infoLoader}}

          			<div class="text-center">
          				<v-progress-circular
          				class="mt-4"
				      	:width="3"
				      	color="#9E7AF3"
				      	indeterminate></v-progress-circular>
          			</div>
        		</v-card-text>
      		</v-card>
    	</v-dialog>
  	</div>
</template>
<script>
  	export default {
  		props:{
  			infoLoader : String
  		},
    	data () {
      		return {
        		dialog: true,
      		}
    	},
	};
</script>