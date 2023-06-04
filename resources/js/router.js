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
            path: '/form',
            name: 'form',
            component: require('./components/web/FormComponent').default
        },
        {
            path: '/ticket',
            name: 'ticket',
            component: require('./components/web/PurchaseTicketComponent').default
        },
          {
            path: '/thanks',
            name: 'thanks',
            component: require('./components/web/ThanksComponent').default
        },
        {
            path: '*',
            name: '404',
            component: require('./components/web/partials/404Component').default
        },
    ]
})
