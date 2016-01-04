<?php
?>

<form method="post">

<input name="name"  value="<?=$this->name?>" />

    <button>submit</button>
</form>

<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>


<form method="post" id="submitPost">

    <input name="name"  value="<?=$this->name?>" />

    <button id="submit">submit</button>
</form>

<script>

    $(function() {

        $("#submit").click(function(e) {
            e.preventDefault();

            $.ajax({
                type : "post",
                url : "/post",
                data : $("#submitPost").serializeArray(),
                success : function(xhr) {

                    alert(xhr.name);

                }
            })
        })


    });
</script>