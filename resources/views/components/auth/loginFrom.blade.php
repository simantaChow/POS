<div class="card w-50 m-auto justify-content-center">
    <label for="email" class="">Email : <input type="text" name="email" id="email"></label>
    <br>
    <label for="password" class="">Password :<input type="password" name="password" id="password"></label>
    <br>
    <button onclick="SubmitLogin()" type="submit" class="btn btn-success"> Login</button>

</div>


<script>
    async function SubmitLogin() {
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;

        if (email.length === 0) {
            errorToast("Email is required");
        } else if (password.length === 0) {
            errorToast("Password is required");
        } else {
            showLoader();
            let res = await axios.post("/login", {email: email, password: password});
            hideLoader()
            if (res.status === 200 && res.data['status'] === 'success') {
                window.location.href = "/dashboard";
            } else {
                errorToast(res.data['message']);
            }
        }
    }


</script>
