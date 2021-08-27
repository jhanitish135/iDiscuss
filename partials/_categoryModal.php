<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/forum/partials/_handlecategory.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Category name</label>
                        <input type="text" class="form-control" name="cname" id="cname">
                    </div>
                    <div class="form-group">
                        <label for="exampleCheck1">Category description</label>
                        <textarea class="form-control" name="cdesp" id="cdesp" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>