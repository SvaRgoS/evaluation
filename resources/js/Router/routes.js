const routes = [
    {
        path: '',
        component: () => import('../Pages/Home'),
        name: 'home'
    },
    {
        path: '/contacts',
        component: () => import('../Pages/Contacts'),
        name: 'contacts',
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/sign-up',
        component: () => import('../Pages/Auth/SignUp'),
        name: 'sign-up'
    },
    {
        path: '/sign-in',
        component: () => import('../Pages/Auth/SignIn'),
        name: 'sign-in'
    },
    {
        path: '/profile',
        component: () => import('../Pages/Auth/Profile'),
        name: 'profile'
    },
]

export default routes;
