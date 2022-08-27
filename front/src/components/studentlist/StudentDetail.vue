<template>
    <div class="card_1">
        <div class="card_header">
           <h1>Detail Info Of : {{student.first_name}} {{student.last_name}}</h1>
        </div>
        <div class="card_body">
            <h4>ID      : {{student.stu_id}}</h4>
            <h4>Name    : {{student.first_name}} {{student.last_name}}</h4>
            <h4>gender  : {{student.gender}}</h4>
            <h4>Email   : {{student.email}}</h4>
            <h4>Class   : {{student.class}}</h4>
            <h4>Batch   : {{student.batch}}</h4>
            <h4>Phone   : {{student.phone}}</h4>
            <h4>Number of Leaves    : {{countLeaves}}</h4>
            <h4>Number of approved  : {{countApproved}}</h4>
            <h4>Number of rejected  : {{countRejected}}</h4>
            <h4>Number of pending   : {{countPending}}</h4>
        </div>
        <div class="card_footer">
        </div>
    </div>
</template>

<script>

export default {
    props: ['student', 'countApproved', 'countRejected', 'countPending', 'countLeaves']
}
</script>
<style scoped>
.card_1{
    margin: auto;
    margin-top: 8%;
    margin-top: 10%;
    width: 70%;
    border-radius: 8px;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
    padding: 0px 0px 10px 0px;
}

h4, h1{
    margin: 10px;
}
.card_header{
    background: #63BFE7;
    border-radius: 8px 8px 0 0;
    text-align: center;
    color:white
}
</style>