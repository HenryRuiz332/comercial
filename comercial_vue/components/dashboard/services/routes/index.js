import Servicios from '../Index'
import ServiciosContratados from '../ServiciosContratados'

const routes = [
   ...route('/servicios', Servicios, {
      Auth: true,
      
   }),
   ...route(`/servicios-contratados`, ServiciosContratados, {
     Auth: true,
    
  }),
]

function route(path, component = Default, meta = {}) {
	return [{
		path,
		component,
		meta
	}]
}

export default routes
