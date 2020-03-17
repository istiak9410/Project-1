<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

               
    <script>
        var adminUrl = '';
        var _modal = $('#modal');
        var btnSave = $('.btnSave');
        var btnUpdate = $('.btnUpdate');
        $.ajaxSetup({
            headers: {'X-CSRF-Token': ''}
        });
        function getRecords() {
            $.get(adminUrl + '/contacts/data')
                .success(function (data) {
                    var html='';
                    data.forEach(function(row){
                        html += '<tr>'
                        html += '<td>' + row.id + '</td>'
                        html += '<td>' + row.name + '</td>'
                        html += '<td>' + row.email + '</td>'
                        html += '<td>' + row.phone + '</td>'
                        html += '<td>'
                        html += '<button type="button" class="btn btn-xs btn-warning btnEdit" title="Edit Record" >Edit</button>'
                        html += '<button type="button" class="btn btn-xs btn-danger btnDelete" data-id="' + row.id + '" title="Delete Record">Delete</button>'
                        html += '</td> </tr>';
                    })
                    $('table tbody').html(html)
                })
        }
        getRecords()
        function reset() {
            _modal.find('input').each(function () {
                $(this).val(null)
            })
        }
        function getInputs() {
            var id = $('input[name="id"]').val()
            var name = $('input[name="name"]').val()
            var email = $('input[name="email"]').val()
            var phone = $('input[name="phone"]').val()
            return {id: id, name: name, email: email, phone: phone}
        }
        function create() {
            _modal.find('.modal-title').text('New Contact');
            reset();
            _modal.modal('show')
            btnSave.show()
            btnUpdate.hide()
        }
        function store(){
            if(!confirm('Are you sure?')) return;
            $.ajax({
                method: 'POST',
                url: adminUrl + '/contacts/store',
                data: getInputs(),
                dataType: 'JSON',
                success: function () {
                    console.log('inserted')
                    reset()
                    _modal.modal('hide')
                    getRecords();
                }
            })
        }
        $('table').on('click', '.btnEdit', function () {
            _modal.find('.modal-title').text('Edit Contact')
            _modal.modal('show')
            btnSave.hide()
            btnUpdate.show()
            var id = $(this).parent().parent().find('td').eq(0).text()
            var name = $(this).parent().parent().find('td').eq(1).text()
            var email = $(this).parent().parent().find('td').eq(2).text()
            var phone = $(this).parent().parent().find('td').eq(3).text()
            $('input[name="id"]').val(id)
            $('input[name="name"]').val(name)
            $('input[name="email"]').val(email)
            $('input[name="phone"]').val(phone)
        })
        function update(){
            if(!confirm('Are you sure?')) return;
            $.ajax({
                method: 'POST',
                url: adminUrl + '/contacts/update',
                data: getInputs(),
                dataType: 'JSON',
                success: function () {
                    console.log('updated')
                    reset()
                    _modal.modal('hide')
                    getRecords();
                }
            })
        }
        $('table').on('click', '.btnDelete', function () {
            if(!confirm('Are you sure?')) return;
            var id = $(this).data('id');
            var data={id:id}
            $.ajax({
                method: 'POST',
                url: adminUrl + '/contacts/delete',
                data:data,
                dataType: 'JSON',
                success: function () {
                    console.log('deleted');
                    getRecords();
                }
            })
        })
    </script>

    </head>
    <body>
        <div class="container">

            <div class="col-md-12">
                <div class="clearfix">
                    <span>Laravel - jQuery CRUD</span>
                    <a class="btn btn-success btn-sm pull-right" onclick="create()">Add New</a>
                </div>
    
                <!--data listing table-->
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>NAME</td>
                        <td>EMAIL</td>
                        <td>PHONE</td>
                        <td>ACTION</td>
                    </tr>
                    </thead>
                    <tbody>
    
                    </tbody>
                </table>
                <!--data listing table-->
    
            </div>
    
        </div>
    
        <!-- modal -->
        <div class="modal fade" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"
                                data-dismiss="modal" aria-hidden="true">&times;
                        </button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control input-sm" type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input class="form-control input-sm" type="email" name="email">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control input-sm" type="text" name="phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    
                        <button type="button" class="btn btn-primary btnSave"
                                onClick="store()">Save
                        </button>
                        <button type="button" class="btn btn-primary btnUpdate"
                                onClick="update()">Update
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


 
    </body>
</html>
