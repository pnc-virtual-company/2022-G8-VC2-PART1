<template>
  <div class="card_1">
    <div class="card-header text-center">
      <h3>Student Detail information</h3>
    </div>
    <div
      class="card-body w-100 d-flex justify-content-between align-items-center"
    >
      <div
        class="side-right d-flex justify-content-center align-items-center w-50"
      >
        <img
          src="../../assets/boy.png"
          style="width: 250px; height: 250px"
          alt=""
        />
      </div>
      <div class="side-left w-50 fs-5">
        <p>Firstname <span>:</span> {{ student.first_name }}</p>
        <p>
          Lastname <span style="margin-left: 5px">:</span>
          {{ student.last_name }}
        </p>
        <p>
          Gender <span style="margin-left: 30px">:</span> {{ student.gender }}
        </p>
        <p>
          Batch <span style="margin-left: 43px">:</span> {{ student.batch }}
        </p>
        <p>
          Email <span style="margin-left: 40px">:</span> {{ student.email }}
        </p>

        <p>
          Phone <span style="margin-left: 35px">:</span> {{ student.phone }}
        </p>
      </div>
    </div>
    <div class="card-footer text-center">
      <router-link to="/studentlist" class="btn btn_back">Back</router-link>
    </div>
    <!-- <div class="card_header">
           <h1>Detail Info Of : {{student.first_name}} {{student.last_name}}</h1>
        </div>
        <div class="card_body">
            <h4>ID      : {{student.studentID}}</h4>
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
        </div> -->
  </div>
</template>

<script>
export default {
  props: [
    "student",
    "countApproved",
    "countRejected",
    "countPending",
    "countLeaves",
  ],
};
</script>
<style scoped>
.card_1 {
  margin: auto;
  width: 70%;
  margin-top: 5%;
  border-radius: 7px;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
  padding: 0px 0px 10px 0px;
}

h4,
h1 {
  margin: 10px;
}
.card-header {
  background: #63bfe7;
  border-radius: 8px 8px 0 0;
  color: white;
}
.card-footer {
  display: flex;
  justify-content: center;
  align-items: center;
  background: none;
}
.btn_back {
  width: 120px;
  padding: 5px;
  margin: 10px;
  font-size: 1.1rem;
  text-decoration: none;
  cursor: pointer;
  background: none;
  border: none;
  background: red;
  color: #ffff;
  border-radius: 7px;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
    rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
}
/* .card_header{
    background: #63BFE7;
    border-radius: 8px 8px 0 0;
    text-align: center;
    color:white
} */
</style>
