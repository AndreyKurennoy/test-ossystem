<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="" >

    <div class="form-group">
        <label for="catagry_name">File</label>
        <input type="file" class="form-control" name="file">
        <input type="hidden" name="_token" value="{{ csrf_token()}}">
    </div>

</form>
</div>
<div class="modelFootr">
    <button type="button" class="addbtn">Add</button>
    <button type="button" class="cnclbtn">Reset</button>
</div>
</div>
</html>

<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous">
</script>

<script>
    $(".addbtn").click(function(){
        var data = new FormData($("#upload_form")[0]);
        console.log(data);
        $.ajax({
            url:'file',
            data :new FormData($("#upload_form")[0]),
//            dataType:'json',
            async:false,
            type:'post',
            processData: false,
            contentType: false,
//            success:function(response){
//                console.log(response);
//            }
        });
    });
</script>