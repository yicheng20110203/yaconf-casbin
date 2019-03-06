<link href="https://v4.bootcss.com/docs/4.0/examples/floating-labels/floating-labels.css" rel="stylesheet">
<form class="form-signin">
    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Login In</h1>
    </div>

    <div class="form-label-group">
        <input type="text" id="username" class="form-control" placeholder="Input username" required autofocus>
        <label for="username">Input username</label>
    </div>

    <div class="form-label-group">
        <input type="password" id="password" class="form-control" placeholder="password" required>
        <label for="password">Password</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="button" id="submit">Sign in</button>
</form>

<script type="text/javascript">
    $(function () {
        $('#submit').click(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/home/login',
                data: {
                    username: $('#username').val(),
                    password: $('#password').val()
                },
                success: function (data) {
                    if (data.code == 0) {
                        window.location.href = '/home/home';
                    } else {
                        alert(data.msg);
                    }
                }
            });
        });
    });
</script>