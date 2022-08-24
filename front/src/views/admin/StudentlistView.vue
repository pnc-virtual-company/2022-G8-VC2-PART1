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
                // {id: 1, first_name: "Phearun", last_name: "Chhun", gender: "Male", email: "phearunchhun10@gmail.com", batch: "BATCH 2022", phone: "012 36 04 77" ,password:"12345678",image:"" },
                // { id: 2, first_name: "Mengyi", last_name: "Yoeng", gender: "Male", email: "menyi@gmail.com", batch: "BATCH 2022", phone: "012 36 04 77" },
            ],
        }
    },
    methods: {
        studentList() {
            axios.get("/social_affairs/students").then((response) => {
                for (let k = 0; k < response.data.length; k++) {
                    console.log(response.data[k]);
                    this.students.push(response.data[k])
                }
            })
        },
    },
    mounted(){
        this.studentList();
    }
}
</script>

<style scoped>

</style>