import VueRouter from 'vue-router'
import auth from '../auth/auth.js'

import Dashboard from '../core/inicio/Dashboard.vue'
import Login from '../core/login/Login.vue'

/* importar rutas */

import products from '../components/dashboard/products/routes/'

import services from '../components/dashboard/services/routes/'

import users from '../components/dashboard/users/routes/'

import collaborators from '../components/dashboard/collaborators/routes/'
 


// import testrutas from '../component/testrutas'

/* importar rutas */

const globlalRoutes = [
	 ...route('/login', Login),
	 ...route('/dashboard', Dashboard, {
 		  Auth: true
 	 }),
 	
 	 ...products,
 	 ...services,
 	 ...users,
	 ...collaborators,

	 
 ]

const routes = [
		...globlalRoutes
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
