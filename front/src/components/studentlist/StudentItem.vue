<template>
    <li>
        <div class="main_card">
            <div class="profile">
                <img src="../../assets/pn-logo.png" alt="" style="width:70px; height:70px">
            </div>
            <div class="student_info">
                <div class="student_name">
                    <p>Name: <span>{{ first_name }}{{ " " }}{{ last_name }}</span></p>
                    <p>Email: <span>{{ email }}</span></p>
                </div>
                <div class="student_class">
                    <p>Class: <span>{{ student_class }}</span></p>
                </div>
            </div>
            <div class="btn">
                <button class="btn_details">DETAILS</button>
                <button class="btn_edit">EDIT</button>
                <button class="btn_delete">DELETE</button>
            </div>
        </div>
    </li>
</template>

<script>
export default {
    props: ['first_name', 'last_name', 'email', 'student_class']
}
</script>

<style scoped>

li {
    padding: 7px;
    list-style-type: none;
}

.main_card {
    width: 70%;
    margin-left: 15%;
    box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0) 0px 4px 6px -1px, rgba(255, 255, 255, 0) 0px 1px 0px inset;
    padding: 20px;
    font-size: 1.2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.student_info {
    width: 50%;
    margin-left: 20px;
}
.btn {
    width:45%;
    display: flex;
    justify-content: end;
    align-items: center;
    margin: 20px;
}

.btn button {
    width: 120px;
    padding: 10px;
    margin: 10px;
    font-size: 1rem;
    text-decoration: none;
    cursor: pointer;
    background: none;
    border: none;
    color: #ffff;
    border-radius: 7px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: rgba(50, 50, 93, 0.4) 0px 2px 5px -1px, rgba(0, 0, 0, 1) 0px 1px 3px -2px;
}

.btn .btn_details {
    background: orange;
    padding: 10px;
}
.btn .btn_edit {
    background: #63BFE7;
    padding: 10px;
}
.btn .btn_delete {
    background: red;
    padding: 10px;
}
</style>
