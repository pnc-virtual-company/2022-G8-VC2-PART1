import { createRouter, createWebHistory } from 'vue-router'
import ListAllLeave from "../views/user/ListAllLeave.vue";
import ProfileUser from "@/views/user/ProfileUser.vue"
import Login from "@/views/login_signup/LogIn.vue"
const routes = [
  
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/',
    name: 'list_all_leave',
    component: ListAllLeave
  },
  {
    path: '/profile',
    name: 'profile',
    component: ProfileUser
  },
  {
    path: '/new_request',
    name: 'new_request',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/user/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
