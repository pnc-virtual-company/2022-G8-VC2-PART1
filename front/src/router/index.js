import { createRouter, createWebHistory } from 'vue-router'
import ListAllLeave from "../views/user/ListAllLeave.vue";
import ProfileUser from "@/views/user/ProfileUser.vue"
import Login from "@/components/formlogin/FormLogin.vue"
import CheckLeave from "@/views/admin/CheckleaveView.vue"
import StudentList from "@/views/admin/StudentlistView.vue";
import StudentDetail from "@/views/admin/StudentDetailView.vue";

const routes = [
  {
    path: "/login",
    name: "login",
    component: Login,
  },
  {
    path: "/",
    name: "list_all_leave",
    component: ListAllLeave,
  },
  {
    path: "/profile",
    name: "profile",
    component: ProfileUser,
  },
  {
    path: "/checkleave",
    name: "checkleave",
    component: CheckLeave,
  },
  {
    path: "/studentlist",
    name: "studentlist",
    component: StudentList,
  },
  {
    path: "/student_details/:studentId",
    name: "student_details",
    component: StudentDetail,
    props: true
  },

  {
    path: "/new_request",
    name: "new_request",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/user/AboutView.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
