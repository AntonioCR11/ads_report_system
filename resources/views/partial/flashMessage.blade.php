@if (Session::has('errorMessage'))
    <div class="d-flex justify-content-center w-100" id="msg_alert">
        <div class="alert alert-danger w-25 mx-auto text-center" style="position: fixed;top:3%;" id="error-alert">
            {{ Session::get('errorMessage') }}
        </div>
    </div>

    <script>
        $("#msg_alert").fadeOut(3000, "swing", function() {
            $("#msg_alert").html("");
        });
    </script>
@elseif (Session::has('successMessage'))
    <div class="d-flex justify-content-center w-100" id="msg_alert">
        <div class="alert alert-success w-25 mx-auto text-center" style="position: fixed;top:3%;" id="error-alert">
            {{ Session::get('successMessage') }}
        </div>
    </div>

    <script>
        $("#msg_alert").fadeOut(3000, "swing", function() {
            $("#msg_alert").html("");
        });
    </script>
@endif
