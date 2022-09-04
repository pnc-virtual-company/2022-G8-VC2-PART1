<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <div class="main" style="padding: 5px;">
        <strong>Dear Teacher,</strong>
        <p style="font-size: 1rem; ">I would like to ask permision :</p>
        <p style="font-size: 1rem; ">Leave Type: {{$leave['leave_type']}}.</p>
        <p style="font-size: 1rem; "> Start Date : {{$leave['start_date']}}.</p>
        <p style="font-size: 1rem; ">End Date : {{$leave['end_date']}}.</p>
        <p style="font-size: 1rem; ">Duration : {{$leave['duration']}} Days</p>
        <p style="font-size: 1rem; "> Reason : {{$leave['reason']}}.</p>
        <div class=" btn" style="display: flex; padding: 10px;">
            <a href="http://localhost:8080/login"
                style=" width:70px; text-align: center;background: green; text-decoration: none; color: white; padding: 5px; border-radius: 10px; margin: 5px;">Approve</a>
            <a href="http://localhost:8080/login"
                style="width:70px;text-align: center; background: red; text-decoration: none; color: white; padding: 5px; border-radius: 10px; margin: 5px;">Reject</a>
        </div>
    </div>
</body>

</html>