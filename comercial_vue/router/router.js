import VueRouter from 'vue-router'
import auth from '../auth/auth.js'

import Inicio from '../base_components/inicio/Inicio.vue'
import Login from '../base_components/login/Login.vue'

/* importar rutas */

// import rutas_clientes from '../modulos/clientes/rutas/rutas_clientes'
// import rutas_proveedores from '../modulos/proveedores/rutas/rutas_proveedores'
// import rutas_albaranes from '../modulos/albaranes/rutas/rutas_albaranes'
// import rutas_recibos from '../modulos/recibos/rutas/rutas_recibos'
// import rutas_contabilidad from '../modulos/contabilidad/rutas/rutas_contabilidad'
// import rutas_morosos from '../modulos/morosos/rutas/rutas_morosos'
// import rutas_usuarios from '../modulos/usuarios/rutas/rutas_usuarios'
// import rutas_gestor_documentos from '../modulos/gestor_documental/rutas/rutas_gestor_documentos'

// import testrutas from '../modulos/testrutas'

/* importar rutas */

const base_routes = [
	 ...route('/login', Login),
	 ...route('/', Inicio, {
 		  Auth: true
 	 }),
	 // ...rutas_clientes,
	 // ...rutas_proveedores,
	 // ...rutas_albaranes,
	 // ...rutas_recibos,
	 // ...rutas_contabilidad,
	 // ...rutas_morosos,
	 // ...rutas_usuarios,
	 // ...rutas_gestor_documentos,
	 // ...testrutas
 ]

const routes = [
		...base_routes
]

const router = new VueRouter({
	routes
})

function route(path, component = Default, meta = {}) {
	return [{
		path,
		component,
		meta
	}]
}

router.beforeEach((to, from, next) => {
	if (to.meta.Auth) {
		const authUser = localStorage.getItem('role')
		if (!auth.authenticated()) {
			next({
				path: '/login',
				query: {
					redirect: to.fullPath
				}
			})
		} else if (to.meta.req_user) {
				(authUser == 2) ? next() : next('/404')
		} else if (to.meta.req_admin) {
				(authUser == 1) ? next() : next('/404')
		} else if (to.meta.req_admin_or_user) {
				(authUser == 1 || authUser == 2 ) ? next() : next('/404')
		} else {
			next()
		}
	} else {
		next()
	}
})

export default router
