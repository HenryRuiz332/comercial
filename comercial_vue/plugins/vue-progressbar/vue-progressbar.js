import Vue from 'vue'
import VueProgressBar  from 'vue-progressbar'

const VueProgessBarOptions = {
	  	color: '#9b7af3',
	  	failedColor: '#f27b7b',
	  	thickness: '7px',
	  	transition: {
	    	speed: '0.2s',
	    	opacity: '0.6s',
	    	termination: 300
  		},
  	autoRevert: true,
  	location: 'top',
  	inverse: false
}

Vue.use(VueProgressBar, VueProgessBarOptions)

