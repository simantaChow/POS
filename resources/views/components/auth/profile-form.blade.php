<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Profile</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input readonly id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstname" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastname" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onUpdate()" class="btn mt-3 w-100  bg-gradient-primary">
                                    Complete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script !src="">
    getProfile();

    async function getProfile() {
        showLoader();
        let res = await axios.get('/userprofile');
        hideLoader();
        if (res.status === 200 && res.data['status'] === 'success') {
            let data = res.data['data'];
            document.getElementById('email').value = data['email'];
            document.getElementById('firstname').value = data['firstname'];
            document.getElementById('lastname').value = data['lastname'];
            document.getElementById('mobile').value = data['mobile'];
            document.getElementById('password').value = data['password'];
        } else {
            errorToast(res.data['message']);
        }
    }

    async function onUpdate() {
        let firstname = document.getElementById('firstname').value;
        let lastname = document.getElementById('lastname').value;
        let mobile = document.getElementById('mobile').value;
        let password = document.getElementById('password').value;

        if (firstname.length === 0) {
            errorToast("First Name is required");
        } else if (lastname.length === 0) {
            errorToast("Last Name is required");
        } else if (mobile.length === 0) {
            errorToast("Mobile is required");
        } else if (password.length === 0) {
            errorToast("Password is required");
        } else {
            showLoader();
            let res = await axios.post("/updateprofile", {
                firstname: firstname,
                lastname: lastname,
                mobile: mobile,
                password: password
            });
            hideLoader();
            if (res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data["message"]);
                await getProfile();
            } else {
                errorToast(res.data['message']);
            }
        }
    }

</script>
