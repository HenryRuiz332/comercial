import Products from '../Index'
import TiposProductos from '../TiposProductos'

const routes = [
   ...route('/productos', Products, {
      Auth: true,
      
   }),
   ...route(`/tipos-productos`, TiposProductos, {
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
