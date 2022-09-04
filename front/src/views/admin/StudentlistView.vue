<template>
   <student_list 
   :students="students" :isGettingData="isGettingData" ></student_list>
</template>

<script>
import StudentList from "@/components/studentlist/StudentList.vue"
import axios from "../../api/api.js"
export default {
    components: {
        "student_list":StudentList
    },
    data() {
        return {
            students: [],
            isGettingData: true,
        }
    },
    methods: {
        studentList() {
            axios.get("/social_affairs/students").then((response) => {
                for (let k = 0; k < response.data.length; k++) {
                    this.students.push(response.data[k]);
                }
                this.isGettingData = false;
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