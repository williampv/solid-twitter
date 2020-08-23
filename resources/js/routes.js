import Home from './components/HomeComponent.vue'
import Profile from './components/ProfileComponent.vue'

const routes = [
    { path: '/', component: Home, name: 'home' },
    { path: '/profile/:id', component: Profile, name: 'profile', props: true}
]

export default routes