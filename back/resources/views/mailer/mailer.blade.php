
<body>
    <div class="main" style="padding: 5px;">
        <strong>Dear Teacher,</strong>
        <p>I would like to ask permision :</p>
        <p>Leave Type: {{$leave['leave_type']}}.</p>
        <p>Start Date : {{$leave['start_date']}}.</p>
        <p>End Date : {{$leave['end_date']}}.</p>
        <p>Duration : {{$leave['duration']}} Days</p>
        <p>Reason : {{$leave['reason']}}.</p>
        <div class="btn" style="display: flex; padding: 10px;">
            <a href="http://localhost:8080/login" style="background: green; text-decoration: none; color: white; padding: 5px; border-radius: 10px; margin: 5px;">Approve</a>
            <a href="http://localhost:8080/login" style="background: red; text-decoration: none; color: white; padding: 5px; border-radius: 10px; margin: 5px;">Reject</a>
        </div>
    </div>
</body>