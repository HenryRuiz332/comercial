import Vue from 'vue'




Vue.prototype.$decimal  = function (value) {

	
    var RE = /^\d*\.?\d*$/;
      if (RE.test(value)) {
         
      } else {
      		// alert('Inserte un numero entero o decimal')
         	return  'Inserte un numero entero o decimal'
          // this.form.largo= []
      }

     
}; 

