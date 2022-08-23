<template>
   <student_list 
   :students="students"></student_list>
</template>

<script>
import StudentList from "@/components/studentlist/StudentList.vue"
import axios from "../../axios-http.js"
export default {
    components: {
        "student_list":StudentList
    },
    data() {
        return {
            students: [
                {id: 1, first_name: "Phearun", last_name: "Chhun", gender: "Male", email: "phearunchhun10@gmail.com", class: "WEP-2022A", generation: "2022" },
                { id: 2, first_name: "Mengyi", last_name: "Yoeng", gender: "Male", email: "menyi@gmail.com", class: "WEP-2022A", generation: "2022" },
                { id: 3, first_name: "Sreyleak", last_name: "El", gender: "Female", email: "sreyleak@gmail.com", class: "WEP-2022A", generation: "2022" },
                { id: 4, first_name: "Sreyleak", last_name: "El", gender: "Female", email: "sreyleak@gmail.com", class: "WEP-2022A", generation: "2022" },
                { id: 5, first_name: "Sreyleak", last_name: "El", gender: "Female", email: "sreyleak@gmail.com", class: "WEP-2022A", generation: "2022" },
            ],
        }
    },
    methods: {
        studentList() {
            axios.get("social_affairs/students").then((response) => {
                console.log(response.data);
            })
        },
    },
}
</script>

<style scoped>
    
</style>