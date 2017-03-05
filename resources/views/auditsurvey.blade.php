@extends('master')
@section('title')
    {{"Survey Auditing"}}
@stop   
@section('style')
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/colorpicker/bootstrap-colorpicker.min.css') }}">

     <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-responsive/css/dataTables.responsive.css') }}">
@stop
@section('content')
<!-- START CONTENT -->
    @section('title-page')
        {{"Survey Auditing"}}
    @stop  
    <!--start container-->
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Something went wrong!</h4>
                {!! implode('', $errors->all(
                    '<li>:message</li>'
                )) !!}
            </div>
        @endif
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                {{ Session::get('message') }}
            </div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Surveyed</h3>
            </div>
            <div class="box-body dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Survey Reference</th>
                            <th>Date of Answer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($survey as $value)
                        <tr>
                            <td class="code">{{$value->intSHId}}</td>
                                <?php
                                    $datesurveyed =  $value->datSHAnswered;
                                    $converteddatesurveyed = date('M j, Y h:i A',strtotime($datesurveyed));
                                ?>
                            <td class="">{{$converteddatesurveyed}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm view" data- toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Survey Reference</th>
                            <th>Date of Survey</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div> 
    <!-- View Form -->
    <div class="hide">
        <form method="POST" action="{{ URL::to('audit/viewsurvey') }}" id="viewform">
            <input type="hidden" name="id" id="viewvote">
        </form>
    </div>
    <!-- View Form -->
@stop 
@section('script')
<script src="{{ URL::asset('assets/datatables/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: false
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>
<script>
    $(document).on("click", ".view", function(){
            var id = $(this).parent().parent().find('.code').text();
            document.getElementById('viewvote').value = id;
            document.getElementById('viewform').submit();
    });
</script>

@stop