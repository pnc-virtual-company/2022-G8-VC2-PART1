<template>
   <student_list 
   :students="students" ></student_list>
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
            students: [],
        }
    },
    methods: {
        studentList() {
            axios.get("/social_affairs/students").then((response) => {
                for (let k = 0; k < response.data.length; k++) {
                    console.log(response.data);
                    this.students.push(response.data[k]);

                }
            })
        },
    },
    provide() {
        return {
            students:this.students
        }
    },
    mounted(){
        this.studentList();
    }
}
</script>

<style scoped>

</style>