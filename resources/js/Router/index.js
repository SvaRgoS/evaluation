import VueRouter from 'vue-router';
import routes from './routes';
import store from '../Store/index'

const router = new VueRouter({
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next()
            return
        }
        next('/sign-in')
    } else {
        next()
    }
})

export default router;

