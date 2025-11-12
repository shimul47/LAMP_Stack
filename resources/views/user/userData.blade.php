@extends('layouts.app')

@section('content')
{{-- {{$user}} --}}
<div class="card-body">
    <div class="table-responsive  ">
        <table class="table data">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Verified At</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Operation</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- Edit --Bootstrap Modal--}}
<div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg">

      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold text-success">Edit Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body pt-0">

        {{-- Edit Form --}}
        <form action="" id="userForm">
            <input type="hidden" id="edit_id" name="id">

            <label for="edit_name" class="form-label fw-semibold">Name</label><br>
            <input type="text" class="form-control" id="name" name="name">
        </form>


      </div>
        <div class="modal-footer border-0">
            <button class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success btn-sm px-4" onclick="saveEdit()">Save</button>
        </div>
    </div>
  </div>
</div>

<script>
    $(document).ready( function () {
        $('.data').DataTable({
            serverSide:true,
            processing:true,
            ajax:{
                url:'{{route("data")}}'
            },
            columns:[
                {data: "name", name:"name"},
                {data:"email",name:"email"},
                {data:"email_verified_at", name:"email_verified_at",render:DataTable.render.datetime("DD MMM YYYY")},
                {data:"created_at", name:"created_at",render: DataTable.render.datetime('DD MMM YYYY : h:mm A')},
                {data:"updated_at",name:"updated_at",render: DataTable.render.datetime('DD MMM YYYY : h:mm A')},
                {data:"operation",name:"operation",orderable:false,searchable:false},
            ],
        });
    });

    function openEditModal(id,name){
        // console.log($("#edit_id").val(id));
        $("#edit_id").val(id);
        $("#name").val(name);
        $("#edit").modal('show');
    }

    function softDelete(id,name,email,created_at){ 
        // console.log(name);
        $.ajax({
            url:`{{route("data_delete")}}`,
            type:"POST",
            data:{ id: id, name: name, email: email, created_at: created_at },
            success:function(res){
                $(".data").DataTable().ajax.reload();
            },
            error: function(err){
                // console.error(err);
                alert("Something went wrong");
            }
        })
    }

    function saveEdit(){
        // let id = document.getElementById("edit_id").value;
        // let name = document.getElementById("name").value;
        let formData = new FormData(document.getElementById("userForm"));
        formData.append("_method","PUT");
        $.ajax({
            url: `{{ route('update') }}`,
            type: "POST",
            data : formData,
            processData: false,
            contentType: false,
            success:function(res){
                $("#edit").modal("hide")
                $(".data").DataTable().ajax.reload();
            },
            error:function(err){
                alert("Something went wrong.")
            }
        })
    }
</script>

@endsection
