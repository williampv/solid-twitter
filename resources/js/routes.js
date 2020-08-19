import Home from './components/HomeComponent.vue'
import User from './components/UserComponent.vue'

const routes = [
    { path: '/', component: Home, name: 'home' },
    { path: '/user', component: User, name: 'user' }
]

export default routes