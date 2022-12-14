import { createRouter, createWebHistory } from 'vue-router';
import ListAllLeave from "../views/user/ListAllLeave.vue";
import ProfileUser from "@/views/user/ProfileUser.vue";
import Login from "@/authentication/FormLogin.vue";
import CheckLeave from "@/views/admin/CheckleaveView.vue";
import StudentList from "@/views/admin/StudentlistView.vue";
import AddStudent from "@/components/studentlist/AddStudent.vue";
import StudentDetailView from "@/views/admin/StudentDetailView.vue";
import Addstudent from "@/components/studentlist/AddStudent.vue";
import ProfileAdmin from "@/views/admin/ProfileAdmin.vue";
import NotFound from '@/views/NotFoundView.vue';
const routes = [
  {
    path: "/",
    name: "list_all_leave",
    meta: {
      needLogin: true,
      needUser: true,
    },
    component: ListAllLeave,
  },
  {
    path: "/login",
    name: "login",
    component: Login,
  },
  {
    path: "/profile_student",
    name: "profile_student",
    meta: {
      needLogin: true,
      needUser: true,
    },
    component: ProfileUser,
  },
  {
    path: "/profile_admin",
    name: "profile",
    meta: {
      needLogin: true,
      needUser: true,
    },
    component: ProfileAdmin,
  },
  {
    path: "/checkleave",
    name: "checkleave",
    meta: {
      needLogin: true,
      needUser: true,
    },
    component: CheckLeave,
  },
  {
    path: "/studentlist",
    name: "studentlist",
    meta: {
      needLogin: true,
      needUser: true,
    },
    component: StudentList,
  },
  {
    path: "/addstudent",
    name: "addstudent",
    meta: {
      needLogin: true,
      needUser: true,
    },
    component: AddStudent,
  },
  {
    path: "/student_details/:studentId",
    name: "student_details",
    component: StudentDetailView,
    props: true,
    meta: {
      needLogin: true,
      needUser: true,
    },
  },
  {
    path:"/addstudent",
    name:"addstudent",
    component:Addstudent,
    meta:{
      needLogin:true,
      needUser:true,
    }
  },
  {
    path: '/:pathMatch(.*)*',
    component: NotFound,
  },

  {
    path: "/new_request",
    name: "new_request",
    meta: {
      needLogin: true,
      needUser: true,
    },
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/user/AboutView.vue"),
  },
];

function authenticationGuard (to, from, next) {
  let needLogin = to.meta.needLogin;
  if (needLogin) {
    if (!localStorage.userRole) {
      next('/login');
      return;
    }
    else {
      if (to.path === '/login') {
        next('/');
      }
      else {
        next();
      }
    }
  }
  
  else {
    if (localStorage.userId) {
      if (to.path === '/login') {
        next('/');
      }
    }
  }
  next();
}

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

router.beforeEach(authenticationGuard);

export default router