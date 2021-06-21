import SMS from '../SMS'
// import ListaClientes from '../partials/ListaClientes'

const routes = [
   ...route('/mensajes', SMS, {
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
