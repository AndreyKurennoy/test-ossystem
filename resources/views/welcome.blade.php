<html>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <div class="container col-md-8">
        <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="" class="form-horizontal" style="padding-top: 20px;">
            <h3>File Input Example</h3>
            <div class="form-group">
                <input id="file-input" type="file" class="form-control" name="file">
            </div>

            <div class="form-group">
                <select name="format" id="format" class="form-control selectpicker ">
                    <option value="json">JSON</option>
                    <option value="xml">XML</option>
                    <option value="csv">CSV</option>
                    <option value="yml">YML</option>
                </select>
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
            </div>

        </form>

        <div class="modelFootr">
            <button type="button" class="addbtn btn btn-primary" disabled>Add</button>
            <button type="button" class="cnclbtn btn btn-danger">Reset</button>
        </div>

        <div id="link-block" class="form-group center-block text-center" style="display: none;">
            <a href="" id="link" class="btn btn-success" download>Download</a>
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
            async:false,
            type:'post',
            processData: false,
            contentType: false,
            success:function(response){
                $('#link').attr('href',response);
                $('#link-block').show();
            }
        });
    });

    $("#file-input").change(function () {

        // get the file name, possibly with path (depends on browser)
        var filename = $(this).val();

        // Use a regular expression to trim everything before final dot
        var extension = filename.replace(/^.*\./, '');

        // If there is no dot anywhere in filename, we would have extension == filename,
        // so we account for this possibility now
        if (extension == filename) {
            extension = '';
        } else {
            // if there is an extension, we convert to lower case
            // (N.B. this conversion will not effect the value of the extension
            // on the file upload.)
            extension = extension.toLowerCase();
        }
        var newOptions = {
            "JSON": "json",
            "XML": "xml",
            "CSV": "csv",
            "YAML": "yaml"
        };
//        console.log(newOptions);
        switch (extension) {


            case 'xml':
                var array = newOptions;
                delete array.XML;
                updateSelectbox(array);
                break;
            case 'csv':
                var array = newOptions;
                delete array.CSV;
                updateSelectbox(array);
                break;
            case 'json':
                var array = newOptions;
                delete array.JSON;
                updateSelectbox(array);
                break;
            case 'yaml':
                var array = newOptions;
                delete array.YAML;
                updateSelectbox(array);
                break;

                // uncomment the next line to allow the form to submitted in this case:
//          break;

            default:
                if(filename !== ""){
                alert('File type is not supported!');
                $('.addbtn').attr("disabled", true);}
                // Cancel the form submission
//                submitEvent.preventDefault();
        }

        function updateSelectbox(att) {
            var select = $('#format');
            select.empty();
            $.each(att, function(key,value) {
                select.append($("<option></option>")
                        .attr("value", value).text(key));
            });
            $('.addbtn').removeAttr("disabled");
        }

    });

    $('.cnclbtn').click(function(){
        $("#file-input").val('');
        $('.addbtn').attr("disabled", true);
    });

</script>
