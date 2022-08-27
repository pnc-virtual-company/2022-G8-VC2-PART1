<template>
    <div class="student_list">
            <add_student></add_student>
        <ul>
            <student_item v-for="student of students" :key="student.id" :student_id="student.id"
                :first_name="student.first_name" :last_name="student.last_name" :batch="student.batch"
                :email="student.email" :image="student.image">
            </student_item>
        </ul>
    </div>
</template>

<script>
import StudentItem from "@/components/studentlist/StudentItem.vue"
import AddStudent from "@/components/studentlist/AddStudent.vue"
export default {
    
    props: { students: Object },
    components: {
        'student_item': StudentItem,
        'add_student': AddStudent,
    },
}
</script>

<style scoped>


.student_list {
    margin-top: 6%;
}


</style>