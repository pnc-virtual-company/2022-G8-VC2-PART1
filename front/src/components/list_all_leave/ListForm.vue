<template>
    <div class="form_filter">
        <div class="filter_by_status">
            <span>Filter By Status</span>
            <select name="cars" id="cars" v-model="status">
                <option value="Show all" selected>Show all</option>
                <option value="Padding">Padding</option>
                <option value="Approve">Approve</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Reject">Reject</option>
            </select>
        </div>
        <div class="filter_by_leave_types">
            <span>Filter By Leave Types</span>
            <select name="cars" id="cars" v-model="leave_type">
                <option value="Show all" selected>Show all</option>
                <option value="Sick Leave">Sick Leave</option>
                <option value="Wedding">Wedding</option>
                <option value="Family's event">Family's event</option>
            </select>
        </div>
        <div class="btn_search">
            <button @click="$emit('filters',status,leave_type)">Search</button>
        </div>
    </div>
</template>

<script>
export default {
    inject: ['list_all_leaves'],
    data() {
        return {
            status: "Show all",
            leave_type: "Show all",
            list_all_leave:[]          
        }
    },
   
}
</script>

<style scoped>



.form_filter {
    width: 100%;
    display: flex;
    margin-bottom: 20px;
    justify-content: space-between;
    align-items: center;
}
.filter_by_status{
    width: 40%;
}
.filter_by_status span{
    padding: 10px;
    font-size: 1.1rem;
    border-radius: 7px;
}
.filter_by_status select{
    width: 100%;
    padding: 10px;
    font-size: 1.1rem;
    border-radius: 7px;
    outline: none;
}
.filter_by_leave_types{
    width: 40%;
}
.filter_by_leave_types span{
    padding: 10px;
    font-size: 1.1rem;
    border-radius: 7px;
}
.filter_by_leave_types select{
    width: 100%;
    padding: 10px;
    font-size: 1.1rem;
    border-radius: 7px;
    outline: none;
}

.btn_search button {
    width: 160px;
    margin-top: 27px;
    padding: 12px 15px;
    text-align: center;
    text-transform: uppercase;
    transition: 0.5s;
    background-size: 200% auto;
    color: white;
    border-radius: 10px;
    display: block;
    border: 0px;
    font-weight: 700;
    background: #63BFE7;
    cursor: pointer;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
}
.btn_search button:hover {
    background-position: right center;
    color: #fff;
    text-decoration: none;
}
.btn_search button:active {
    transform: scale(0.95);
}
</style>