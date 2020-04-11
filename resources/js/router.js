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
            path: '*',
            name: '404',
            component: require('./components/web/partials/404Component').default
        }
    ]
})
