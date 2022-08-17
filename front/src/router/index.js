import { createRouter, createWebHistory } from 'vue-router'
import ListAllLeave from "../views/ListAllLeave.vue";

const routes = [
  {
    path: '/',
    name: 'list_all_leave',
    component: ListAllLeave
  },
  {
    path: '/new_request',
    name: 'new_request',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
