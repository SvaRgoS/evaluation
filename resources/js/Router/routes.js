const routes = [
    {
        path: '',
        component: () => import('../Pages/Home'),
        name: 'home'
    },
    {
        path: '/contacts',
        component: () => import('../Pages/ContactsList'),
        name: 'contacts',
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/contacts/add',
        component: () => import('../Pages/ContactsEdit'),
        name: 'contacts-add',
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/contacts/:id',
        component: () => import('../Pages/ContactsEdit'),
        name: 'contacts-edit',
        props: true,
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
        component: () => import('../Pages/Profile'),
        name: 'profile'
    },
]

export default routes;
