@extends('layouts.admin')
@section('content')

                <main>
                    <div class="container-fluid px-4">
                        <div class="my-4">
                            <h4 class="mt-4 d-inline">Categories</h4>
                            <a href="{{route('backend.categories.create')}}" class="btn btn-primary float-end">Add Category</a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Category Lists
                            </div>
                            <div class="card-body">
                                <table id="" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="w-25">Photo.</th>
                                            <th class="w-25">Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="w-25">Photo.</th>
                                            <th class="w-25">Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="item_tbody">
                                    @foreach($categories as $category)
                                        <tr>
                                            
                                            <td><img src="{{$category->photo}}" alt="" class="w-25"></td>
                                            <td>{{$category->name}}</td>
                                            <td>
                                                <a href="{{route('backend.categories.edit',$category->id)}}" class="btn btn-sm btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                                                 <button class="btn btn-danger btn-sm delete" data-id="{{$category->id}}"><i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>               


<!-- Delete  -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModallabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModallabel">Item Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3>Are you Sure Delete?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="" method="POST" id="deleteForm">
            {{csrf_field()}}
            {{method_field('delete')}}
            <button type="submit" class="btn btn-primary">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            // alert('hello');
            $('#item_tbody').on('click','.delete',function(){
            let id=$(this).data('id');
            $('#deleteForm').prop('action','categories/'+id);
            $('#deleteModal').modal('show');
            })
        })
    </script>
@endsection