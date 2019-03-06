<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <textarea class="form-control" id="content" rows="22" style="font-size: 14px;" readonly>
<?= $config ?>
            </textarea>
                <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_yaconf">publish `<?=$env?>` yaconf file</button>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning alert-dismissible fade hide" role="alert">
                    <strong id="sub_result"></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" onclick="clickCloseAction()">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function clickCloseAction() {
        window.location.href = '/home/home';
    }

    $(function () {
        $('#submit_yaconf').click(function(){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/home/save-config',
                data: {
                    env: "<?=$env?>"
                },
                success: function (data) {
                    if (data.code == 0) {
                        $('#sub_result').html('Success!');
                        $(".alert").removeClass('hide').addClass('show').alert();
                    } else {
                        $('#sub_result').html(data.msg);
                        $(".alert").removeClass('hide').addClass('show').alert();
                    }
                }
            });
        });
    });
</script>