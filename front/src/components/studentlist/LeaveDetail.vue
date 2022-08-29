
<template>
    <div class="leave_card">
        
        <h4>Requst Date  : {{leave.created_at}}</h4>
        <h4>Start Date   : {{leave.start_date}}</h4>
        <h4>End Date   : {{leave.end_date}}</h4>
        <h4>Duration   : {{leave.duration}}</h4>
        <h4>Leave Type   : {{leave.leave_type}}</h4>
        <h4>Reason    : {{leave.reason}}</h4>
        <h4>Status  : {{leave.status}}</h4>
        <hr>
    </div>
</template>

<script>
export default {
    props:['leave']
}
</script>

<style scoped>
    .leave_card{
       margin: 10px;
    }
</style>