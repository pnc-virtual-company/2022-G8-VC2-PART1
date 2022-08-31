<template>
<div class="hw">
    <student_detail 
    :student="student" :countLeaves="countLeaves"
    :countApproved="countApproved" :countRejected="countRejected" 
    :countPending="countPending"
    ></student_detail> 
</div>
</template>

<script>
import StudentDetail from '@/components/studentlist/StudentDetail.vue'
import axios from "../../axios-http.js"

export default {
    components: {
        "student_detail": StudentDetail
    },
    
    props: ['studentId'],

    data(){
        return{
            student:{},
            leaves: [],
            countLeaves: 0,
        }
    },

    computed: {
        countApproved() {
            let counter = 0;
            this.leaves.forEach(eachLeave => {
                if (eachLeave.status == "approved") {
                    counter++;
                }
            });

            return counter;
        },

        countRejected() {
            let counter = 0;
            this.leaves.forEach(eachLeave => {
                if (eachLeave.status == "rejected") {
                    counter++;
                }
            });

            return counter;
        },

        countPending() {
            let counter = 0;
            this.leaves.forEach(eachLeave => {
                if (eachLeave.status == "pending") {
                    counter++;
                }
            });

            return counter;
        },
    },

    created() {
        axios.get("social_affairs/one_student_leaves/" + this.studentId).then(res=>{
            this.student = res.data;
            this.leaves = res.data.leaves;
            this.countLeaves = res.data.leaves.length;
        })
    }
};
</script>
<style scoped>

</style>