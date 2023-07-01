import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export default new VueRouter ({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: require('./components/web/HomeComponent').default
        },
        {
            path: '/posts',
            name: 'posts',
            component: require('./components/web/posts/IndexComponent').default
        },
        {
            path: '/posts/:post',
            name: 'posts.show',
            component: require('./components/web/posts/ShowComponent').default
        },
        {
            path: '/purchase',
            name: 'purchase',
            component: require('./components/web/PurchaseComponent').default
        },
        {
            path: '/posts/:post/form',
            name: 'posts.form',
            component: require('./components/web/FormComponent').default
        },
        {
            path: '/posts/:post/tickets',
            name: 'posts.tickets',
            component: require('./components/web/PurchaseTicketComponent').default
        },
        {
            path: '/thanks',
            name: 'thanks',
            component: require('./components/web/ThanksComponent').default
        },
        {
            path:'/posts/:post/banks',
            name: 'posts.banks',
            component: require('./components/web/BankInfoComponent').default
        },
        {
            path: '*',
            name: '404',
            component: require('./components/web/partials/404Component').default
        },
    ]
})
