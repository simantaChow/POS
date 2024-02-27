<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryNameUpdate">
                                <input readonly class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal"
                        aria-label="Close">Close
                </button>
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success">Update</button>
            </div>
        </div>
    </div>
</div>


<script !src="">

    async function FillUpdateForm(id, name) {
        this.id = $('#updateID').val();
        this.name = $('#categoryNameUpdate').val();
    }

    async function Update() {
        let id = $('#updateID').val();
        let name = $('#categoryNameUpdate').val();
        $('#update-modal-close').click();

        if (name.length === 0) {
            errorToast('Name Required');
            $('#update-modal').modal('show');
        } else {
            showLoader();
            let res = await axios.post('/categoryupdate', {id: id, name: name});
            hideLoader();

            if (res.status === 200 & res.data===1) {
                $('#update-form').trigger("reset");
                successToast('Request Success');
                await getList();
            } else {
                errorToast('Request Fail');
            }

        }

    }

</script>

