<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">

    <!-- CSRF token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}" />

    <title>Manage Students</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">

    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="{{ asset('icheck/square/yellow.css') }}">

    <!-- toastr notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .panel-heading {
            padding: 0;
        }

        .panel-heading ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .panel-heading li {
            float: left;
            border-right: 1px solid #bbb;
            display: block;
            padding: 14px 16px;
            text-align: center;
        }

        .panel-heading li:last-child:hover {
            background-color: #ccc;
        }

        .panel-heading li:last-child {
            border-right: none;
        }

        .panel-heading li a:hover {
            text-decoration: none;
        }

        .table.table-bordered tbody td {
            vertical-align: baseline;
        }
    </style>

</head>

<body>
    @if (Auth::check())
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center">Manage Students</h2>
            <br />

            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul>
                        <li>
                            <a href="{{ url('/') }}" class="home-button">
                                <i class="fa fa-home"></i> Home
                            </a>
                        </li>
                        <li><i class="fa fa-file-text-o"></i> All the current Students</li>
                        <a href="#" class="add-modal">
                            <li>Add Students</li>
                        </a>
                    </ul>
                </div>

                <div class="panel-body">
                    <div id="postTableWrapper">
                        <table class="table table-striped table-bordered table-hover" id="postTable">
                            <!-- Your existing table structure here -->
                            <thead>
                                <tr>
                                    <th valign="middle">#</th>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Confirm</th>
                                    <th>Last updated</th>
                                    <th>Actions</th>
                                </tr>
                                {{ csrf_field() }}
                            </thead>
                            <tbody>
                                @foreach ($posts as $indexKey => $post)
                                    <tr
                                        class="item{{ $post->id }} @if ($post->is_published) warning @endif">
                                        <td class="col1">{{ $indexKey + 1 }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            {{ App\Post::getExcerpt($post->content) }}
                                        </td>
                                        <td class="text-center"><input type="checkbox" class="published" id=""
                                                data-id="{{ $post->id }}"
                                                @if ($post->is_published) checked @endif>
                                        </td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->updated_at)->diffForHumans() }}
                                        </td>
                                        <td>
                                            <button class="show-modal btn btn-success" data-id="{{ $post->id }}"
                                                data-title="{{ $post->title }}" data-content="{{ $post->content }}">
                                                <span class="glyphicon glyphicon-eye-open"></span> </button>
                                            <button class="edit-modal btn btn-info" data-id="{{ $post->id }}"
                                                data-title="{{ $post->title }}" data-content="{{ $post->content }}">
                                                <span class="glyphicon glyphicon-edit"></span> </button>
                                            <button class="delete-modal btn btn-danger" data-id="{{ $post->id }}"
                                                data-title="{{ $post->title }}" data-content="{{ $post->content }}">
                                                <span class="glyphicon glyphicon-trash"></span> </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.panel-body -->
            </div><!-- /.panel panel-default -->
        </div><!-- /.col-md-8 -->

        @include('delete')
        @include('edit')
        @include('show')
        @include('add')

        <!-- jQuery -->
        {{-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script> --}}
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
            crossorigin="anonymous"></script>

        <!-- Bootstrap JavaScript -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>

        <!-- Include toastr and icheck scripts -->
        <!-- toastr notifications -->
        {{-- <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script> --}}
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <!-- icheck checkboxes -->
        <script type="text/javascript" src="{{ asset('icheck/icheck.min.js') }}"></script>

        <!-- Delay table load until everything else is loaded -->
        <script>
            $(window).load(function() {
                $('#postTable').removeAttr('style');
            })
        </script>

        <script>
            $(document).ready(function() {
                $('.published').iCheck({
                    checkboxClass: 'icheckbox_square-yellow',
                    radioClass: 'iradio_square-yellow',
                    increaseArea: '20%'
                });
                $('.published').on('ifClicked', function(event) {
                    id = $(this).data('id');
                    $.ajax({
                        type: 'POST',
                        url: "{{ URL::route('changeStatus') }}",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id': id
                        },
                        success: function(data) {
                            // empty
                        },
                    });
                });
                $('.published').on('ifToggled', function(event) {
                    $(this).closest('tr').toggleClass('warning');
                });
            });
        </script>

        <!-- AJAX CRUD operations -->
        <script type="text/javascript">
            // add a new post
            $(document).on('click', '.add-modal', function() {
                // Empty input fields
                $('#title_add').val('');
                $('#content_add').val('');

                $('.modal-title').text('Add');
                $('#addModal').modal('show');
            });
            $('.modal-footer').on('click', '.add', function() {
                // Check if the title already exists
                var title = $('#title_add').val();
                $.ajax({
                    type: 'POST',
                    url: 'posts',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'title': $('#title_add').val(),
                        'content': $('#content_add').val()
                    },
                    success: function(data) {
                        $('.errorTitle').addClass('hidden');
                        $('.errorContent').addClass('hidden');

                        if ((data.errors)) {
                            setTimeout(function() {
                                $('#addModal').modal('show');
                                toastr.error('Validation error!', 'Error Alert', {
                                    timeOut: 5000
                                });
                            }, 500);

                            if (data.errors.title) {
                                $('.errorTitle').removeClass('hidden');
                                $('.errorTitle').text(data.errors.title);
                            }
                            if (data.errors.content) {
                                $('.errorContent').removeClass('hidden');
                                $('.errorContent').text(data.errors.content);
                            }
                        } else {
                            toastr.success('Successfully added Post!', 'Success Alert', {
                                timeOut: 5000
                            });
                            $('#postTable').prepend("<tr class='item" + data.id + "'><td class='col1'>" +
                                data.id + "</td><td>" + data.title + "</td><td>" + data.content +
                                "</td><td class='text-center'><input type='checkbox' class='new_published' data-id='" +
                                data.id +
                                " '></td><td>Just now!</td><td><button class='show-modal btn btn-success' data-id='" +
                                data.id + "' data-title='" + data.title + "' data-content='" + data
                                .content +
                                "'><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='edit-modal btn btn-info' data-id='" +
                                data.id + "' data-title='" + data.title + "' data-content='" + data
                                .content +
                                "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='delete-modal btn btn-danger' data-id='" +
                                data.id + "' data-title='" + data.title + "' data-content='" + data
                                .content +
                                "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                            $('.new_published').iCheck({
                                checkboxClass: 'icheckbox_square-yellow',
                                radioClass: 'iradio_square-yellow',
                                increaseArea: '20%'
                            });
                            $('.new_published').on('ifToggled', function(event) {
                                $(this).closest('tr').toggleClass('warning');
                            });
                            $('.new_published').on('ifChanged', function(event) {
                                id = $(this).data('id');
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ URL::route('changeStatus') }}",
                                    data: {
                                        '_token': $('input[name=_token]').val(),
                                        'id': id
                                    },
                                    success: function(data) {
                                        // empty
                                    },
                                });
                            });
                            $('.col1').each(function(index) {
                                $(this).html(index + 1);
                            });
                        }
                    },
                });
            });

            // Show a post
            $(document).on('click', '.show-modal', function() {
                $('.modal-title').text('Show');
                $('#id_show').val($(this).data('id'));
                $('#title_show').val($(this).data('title'));
                $('#content_show').val($(this).data('content'));
                $('#showModal').modal('show');
            });


            // Edit a post
            $(document).on('click', '.edit-modal', function() {
                $('.modal-title').text('Edit');
                $('#id_edit').val($(this).data('id'));
                $('#title_edit').val($(this).data('title'));
                $('#content_edit').val($(this).data('content'));
                id = $('#id_edit').val();
                $('#editModal').modal('show');
            });
            $('.modal-footer').on('click', '.edit', function() {
                $.ajax({
                    type: 'PUT',
                    url: 'posts/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': $("#id_edit").val(),
                        'title': $('#title_edit').val(),
                        'content': $('#content_edit').val()
                    },
                    success: function(data) {
                        $('.errorTitle').addClass('hidden');
                        $('.errorContent').addClass('hidden');

                        if ((data.errors)) {
                            setTimeout(function() {
                                $('#editModal').modal('show');
                                toastr.error('Validation error!', 'Error Alert', {
                                    timeOut: 5000
                                });
                            }, 500);

                            if (data.errors.title) {
                                $('.errorTitle').removeClass('hidden');
                                $('.errorTitle').text(data.errors.title);
                            }
                            if (data.errors.content) {
                                $('.errorContent').removeClass('hidden');
                                $('.errorContent').text(data.errors.content);
                            }
                        } else {
                            toastr.success('Successfully updated Post!', 'Success Alert', {
                                timeOut: 5000
                            });
                            $('.item' + data.id).replaceWith("<tr class='item" + data.id +
                                "'><td class='col1'>" + data.id + "</td><td>" + data.title +
                                "</td><td>" + data.content +
                                "</td><td class='text-center'><input type='checkbox' class='edit_published' data-id='" +
                                data.id +
                                "'></td><td>Right now</td><td><button class='show-modal btn btn-success' data-id='" +
                                data.id + "' data-title='" + data.title + "' data-content='" + data
                                .content +
                                "'><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='edit-modal btn btn-info' data-id='" +
                                data.id + "' data-title='" + data.title + "' data-content='" + data
                                .content +
                                "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='delete-modal btn btn-danger' data-id='" +
                                data.id + "' data-title='" + data.title + "' data-content='" + data
                                .content +
                                "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>"
                            );

                            if (data.is_published) {
                                $('.edit_published').prop('checked', true);
                                $('.edit_published').closest('tr').addClass('warning');
                            }
                            $('.edit_published').iCheck({
                                checkboxClass: 'icheckbox_square-yellow',
                                radioClass: 'iradio_square-yellow',
                                increaseArea: '20%'
                            });
                            $('.edit_published').on('ifToggled', function(event) {
                                $(this).closest('tr').toggleClass('warning');
                            });
                            $('.edit_published').on('ifChanged', function(event) {
                                id = $(this).data('id');
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ URL::route('changeStatus') }}",
                                    data: {
                                        '_token': $('input[name=_token]').val(),
                                        'id': id
                                    },
                                    success: function(data) {
                                        // empty
                                    },
                                });
                            });
                            $('.col1').each(function(index) {
                                $(this).html(index + 1);
                            });
                        }
                    }
                });
            });

            // delete a post
            $(document).on('click', '.delete-modal', function() {
                $('.modal-title').text('Delete');
                $('#id_delete').val($(this).data('id'));
                $('#title_delete').val($(this).data('title'));
                $('#deleteModal').modal('show');
                id = $('#id_delete').val();
            });
            $('.modal-footer').on('click', '.delete', function() {
                $.ajax({
                    type: 'DELETE',
                    url: 'posts/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function(data) {
                        toastr.success('Successfully deleted Post!', 'Success Alert', {
                            timeOut: 5000
                        });
                        $('.item' + data['id']).remove();
                        $('.col1').each(function(index) {
                            $(this).html(index + 1);
                        });
                    }
                });
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="{{ asset('icheck/icheck.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                // DataTable initialization
                var postTable = $('#postTable').DataTable({
                    "order": [
                        [0, "asc"]
                    ],
                    "columnDefs": [{
                        "orderable": false,
                        "targets": [4, 5]
                    }],
                    "drawCallback": function(settings) {
                        updateDataTableInfo();
                    }
                });
        
                // Function to update DataTable information
                function updateDataTableInfo() {
                    var info = postTable.page.info();
                    $('#postTable_info').html('Showing ' + (info.start + 1) + ' to ' + info.end + ' of ' + info.recordsDisplay + ' entries');
                }
        
                // Trigger updateDataTableInfo on DataTable draw event
                postTable.on('draw.dt', function() {
                    updateDataTableInfo();
                });
        
                // Simulating add operation
                $('#addButton').on('click', function() {
                    // Your actual add operation logic goes here
        
                    // Reload the DataTable to reflect the changes
                    $('#postTable').DataTable().ajax.reload();
                });
        
                // Simulating delete operation
                $('#deleteButton').on('click', function() {
                    // Your actual delete operation logic goes here
        
                    // Reload the DataTable to reflect the changes
                    $('#postTable').DataTable().ajax.reload();
                });
            });
        </script>

    @else
        <script>
            // Redirect to login page if not logged in
            window.location.href = "{{ url('/login') }}";
        </script>
    @endif
</body>

</html>
