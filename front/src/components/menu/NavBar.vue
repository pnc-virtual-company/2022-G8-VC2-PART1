<template>
    <div class="container">
        <nav>
            <div class="left_side_bar">
                <div class="logo_display">
                    <img src="../../assets/pn-logo.png" alt="">
                    <p>SLMS</p>
                </div>
                <div class="router">
                    <router-link to="/">List All Leaves</router-link> 
                    <router-link to="/new_request">New Request</router-link>
                </div>
            </div>
            <div class="user_name">
                <div class="user_profile">
                    <router-link to="/profile">Phearun Chhun</router-link>
                </div>
                <div class="btn_sign_out">
                    <button>Signout</button>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>



* {
    padding: 0;
    margin: 0;
    font-family: 'Roboto Slab', serif;
}
nav {
    background: #63BFE7;
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 9999;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

nav a {
    text-decoration: none;
    color: #ffff;
    display: flex;
    margin: 10px;
    justify-content: center;
    align-items: center;
    font-size: 1.2rem;
}
nav .router a.router-link-exact-active {
    color:#fff;
    background: orange;
    padding: 12px;
    /* margin: 10px; */
}
nav .user_name a.router-link-exact-active {
    color:#63BFE7;
    padding: 12px;
    background: #fff;
    
    /* margin: 10px; */
}
/* nav  a.router-link-exact-active {
    color: #ffff;
    background: orange;
    padding: 12px;
    margin: 10px;
} */

.logo_display {
    display: flex;
    align-items: center;
}
.logo_display img{
    width: 60px;
    height: 60px;
}
.logo_display p{
    color:#ffff;
    margin-left: 10%;
    font-size: 1.5rem;
}

.left_side_bar{
    width: 40%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.router {
    display: flex;
    justify-content: center;
    align-items: center;
}
.user_name {
    width: 20%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.user_name .btn_sign_out {
    margin: 10px;
}
.user_profile button{
    background: none;
    border: none;
    cursor: pointer;
}
</style>