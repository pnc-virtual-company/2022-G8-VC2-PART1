<template>
    <div class="container">
        <button type="button" class="btn btn-primary btn-add  mt-4" data-bs-toggle="modal"
            data-bs-target="#myModal">+Add Student</button>
        <div class="modal " id="myModal">
            <div class="modal-dialog">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title text-light ">ADD STUDENT</h5>
                        <button type="button" class="btn-close btn-close-light" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-2">
                                <label class="form-label required">Username</label>
                                <div class="input d-flex justify-content-between">
                                    <input type="text" class="form-control " placeholder="firstname">
                                    <input type="text" class="form-control " placeholder="lastname">
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input d-flex justify-content-between">
                                    <div class="gender">
                                        <label class="form-label required">Gender</label>
                                        <select class="form-select form-select-md  mb-3"
                                            aria-label=".form-select-lg example">
                                            <option selected>Select gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>

                                    </div>
                                    <div class="batch">
                                        <label class="form-label required">Batch</label>
                                        <select class="form-select form-select-md  mb-3"
                                            aria-label=".form-select-lg example">
                                            <option selected>Select batch</option>
                                            <option value="batch2022">Batch 2022</option>
                                            <option value="batch2023">Batch 2023</option>
                                            <option value="batch2024">Batch 2024</option>
                                            <option value="batch2025">Batch 2025</option>
                                            <option value="batch2026">Batch 2026</option>
                                            <option value="batch2027">Batch 2027</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label required">Email</label>
                                <input type="email" class="form-control" placeholder="email">
                            </div>
                            <div class="mb-1">
                                <label class="form-label required">Phone number</label>
                                <input type="text" class="form-control " placeholder="phone number">
                            </div>
                            <div class="mb-1">
                                <label class="form-label required">Password</label>
                                <input type="password" class="form-control " placeholder="password">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>



.modal-header{
    background: #63BFE7;
}

.btn-add{
    margin-left: 85%;
    position: fixed;
    z-index: 999;
}
.modal{
    margin-top: 3.5%;
}
.input .form-control{
    width: 48%;

}
.gender, .batch {
    width: 48%;

}
.form-label{
    font-weight: bold;
}
</style>