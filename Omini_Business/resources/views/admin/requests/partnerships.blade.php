@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />

<style>

    .required:after {

        content: "*";

        color: red;

    }

    .error{

        color:red;

    }


table.dataTable tbody td {

    word-break: break-word;

    vertical-align: top;

}

.bootstrap-tagsinput .tag {

        background: #3bafda;

        border: 1px solid #3bafda;

        padding: 0 6px;

        margin-right: 2px;

        color: white;

        border-radius: 4px;

    }

    .bootstrap-tagsinput {

        width: 100% !important;

        height: calc(2.75rem + 2px) !important;

    }

    .select2-container{
        width: 362px !important;
        display: inline !important;

    }
    .dataTables_scrollBody
    {
    overflow-x:hidden !important;
    overflow-y:auto !important;
    }
</style>

<div class="app-content content">

    <div class="content-wrapper">

        <br>

        @include('alert.messages')

        <div class="row">

            <div class="col-sm-12">

                <div class="card">

                    <div class="card-header">

                        <h4 class="card-title">Partnership List</h4>

                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>


                    </div>

                    <div class="card-content collapse show">

                        <div class="card-body card-dashboard">

                            <table class="table table-striped table-bordered dom-jQuery-events dataTable" id="DataTables" role="grid" aria-describedby="DataTables_Table_0_info">

                                <thead>

                                    <tr role="row">

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>

                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($partnerships as $item)

                                    <tr role="row" class="odd">

                                        <td>{{$item->name}}</td>
                                        <td>
                                            {{$item->email}}
                                        </td>
                                        <td>{{$item->phone}}</td>


                                    </tr>

                                    <div class="modal fade text-left show" id="editBrandModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" style="padding-right: 17px;">

                                        <div class="modal-dialog" role="document">

                                          <div class="modal-content">

                                            <div class="modal-header">

                                              <h3 class="modal-title" id="myModalLabel35"> Edit Brand Details</h3>

                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                <span aria-hidden="true">×</span>

                                              </button>

                                            </div>

                                            <form method="POST" action="{{url('admin/edit/brand')}}/{{$item->id}}">

                                                @csrf

                                              <div class="modal-body">

                                                    <fieldset class="form-group floating-label-form-group">

                                                      <label for="email" class="label-control required">Name</label>

                                                      <input type="text" class="form-control" id="editname" name="editname" value="{{$item->name}}">

                                                        @if ($errors->has('editname'))

                                                            <span class="help-block">

                                                                <strong class="error">{{ $errors->first('editname') }}</strong>

                                                            </span>

                                                        @endif

                                                    </fieldset>
                                                    <fieldset class="form-group floating-label-form-group">
                                                        <label for="email" class="label-control required">Technology</label>
                                                        
                                                    </fieldset>

                                                    <fieldset class="form-group floating-label-form-group">

                                                        <label for="email" class="label-control">Status</label>


                                                    </fieldset>

                                              </div>

                                              <div class="modal-footer">

                                                  <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">

                                                  <input type="submit" class="btn btn-outline-primary btn-lg" value="Update">

                                              </div>

                                            </form>

                                          </div>

                                        </div>

                                    </div>

                                    @empty

                                    @endforelse

                                    

                                </tbody>

                            </table>

                            

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!--Import jQuery before export.js-->

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>

<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

<!--Data Table-->

<script type="text/javascript"  src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<script type="text/javascript"  src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>



<!--Export table buttons-->

<script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js" ></script>

<script type="text/javascript"  src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>



<script>

    $(document).ready(function() {
       
        $.noConflict();
        var table = $('#DataTables').DataTable({
                        "sDom":"ltipr",
            "paging":true,
            "searching": true,
            "info": false,
            "ordering": false
        });
    });

</script>



@endsection