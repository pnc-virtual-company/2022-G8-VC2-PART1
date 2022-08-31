<template>
  <div class="profile_admin">
    <div class="profile_image">
      <img
        src="../../assets/boy.png"
        alt=""
        style="width: 100px; height: 100px"
      />
    </div>
    <div class="admin_info d-flex justify-content-between align-center bg-danger w-100 text-light text-center">
        <div class="side_left w-50 bg-warning">
            <h1>side left</h1>
        </div>
        <div class="side_right w-50 bg-success">
            <h1>side right</h1>
        </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.profile_admin {
  margin-top: 8%;
  width: 50%;
  margin-left: 25%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #fff;
  box-shadow: rgba(50, 50, 93, 0.4) 0px 2px 5px -1px,
    rgba(0, 0, 0, 0.7) 0px 1px 3px -1px;
  border-radius: 7px;
  color: #63bfe7;
  padding: 10px;
}
</style>