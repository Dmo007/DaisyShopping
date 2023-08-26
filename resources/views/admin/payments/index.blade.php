@extends('layouts.admin')
@section('content')

    <main>
        <div class="container-fluid px-4">
            <div class="my-4">
            <h3 class="mt-4 d-inline">Payments</h3>
            <a href="{{route('backend.payments.create')}}" class="btn btn-primary float-end">Add Payment</a>

            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Payment Lists
                </div>
                <div class="card-body">
                    <table id="" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="w-25">Logo</th>
                                <th>Payment Name</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="w-25">Logo</th>
                                <th>Payment Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody id="item_tbody">
                        @foreach($payments as $payment)
                            <tr>
                                <td><img src="{{$payment->logo}}" alt="" class="w-25"></td>
                                <td>{{$payment->name}}</td>
                                <td>
                                    <a href="{{route('backend.payments.edit',$payment->id)}}" class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <button class="btn btn-danger btn-sm delete" data-id="{{$payment->id}}"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </main>

<!-- Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="deleteModalLabel">Payment Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <h3>Are you sure to Delete?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="" id="deleteForm" method="POST">
            {{csrf_field()}}
            {{method_field('delete')}}
            <button type="submit" class="btn btn-danger">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>
                
@endsection
@section('script')

    <script>
        $(document).ready(function(){
            $('#item_tbody').on('click','.delete',function(){
                // alert('df');
                let id=$(this).data('id');
                $('#deleteForm').prop('action','payments/'+id);
                $('#deleteModal').modal('show');
            })
        })
    </script>

@endsection
