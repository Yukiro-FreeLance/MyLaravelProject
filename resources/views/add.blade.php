
        <!-- Modal form to add a post -->
        <div id="addModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="title">Student&nbsp;ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title_add" autofocus
                                        placeholder="Student ID">
                                    <p class="errorTitle text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="content">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="content_add"
                                        placeholder="Student Name">
                                    <p class="errorContent text-center alert alert-danger hidden"></p>
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success add" data-dismiss="modal">
                                <span id="" class='glyphicon glyphicon-check'></span> Add
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
