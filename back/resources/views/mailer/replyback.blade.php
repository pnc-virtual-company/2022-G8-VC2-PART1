<body>
    <div class="replay" style="padding:5px;">
        <p>Your request leave has been <strong>{{$leave['status']}}</strong>.</p>
    </div>
    <div class="go btn " style="padding: 20px;">
        <a href="http://localhost:8080/login"
            style="background: blue; text-decoration: none; color: white; padding: 15px; border-radius: 10px; margin: 5px;">Go
            to
            App</a>
    </div>

</body>
<style>
.btn {
    width: 80px;
    padding: 5px;
    cursor: pointer;
    margin: 3px;
    border: none;
    font-size: 15px;
    color: white;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    border-radius: 7px;
}
</style>