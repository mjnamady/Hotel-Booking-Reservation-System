@extends('admin.admin_dashboard')
@section('admin')

<style>
    .large-checkbox{
        transform: scale(1.5)
    }
</style>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Comments</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Comments</li>
                </ol>
            </nav>
        </div>
       
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>S\N</th>
                            <th>User Name</th>
                            <th>Post Title</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $key => $comment)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ Str::limit($comment['post']['post_title'], 30) }}</td>
                            <td>{{ Str::limit($comment->message, 40) }}</td>
                            <td>
                                <div class="form-check-danger form-check form-switch">
                                    <input class="form-check-input comment-toggle large-checkbox" type="checkbox" 
                                    data-comment-id="{{$comment->id}}"
                                    {{ $comment->status ? 'checked' : '' }}
                                    id="flexSwitchCheckCheckedDanger">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
    <hr/>
   
</div>

<script>

$(document).ready(function(){
    $('.comment-toggle').on('change', function(){
        var commentId = $(this).data('comment-id');
        var isChecked = $(this).is(':checked');
        
        // Send an ajax request to update comment status
        $.ajax({
            url: "{{ route('update.comment.status') }}",
            method: "POST",
            data: {
                comment_id: commentId,
                is_checked: isChecked ? 1 : 0,
                _token: "{{ csrf_token() }}"
            },
            success: function (response){
                toastr.success(response.message)
            },
            error: function (){

            }
        });
    });
});


</script>



@endsection