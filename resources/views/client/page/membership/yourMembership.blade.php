@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h1 class="text-warning mt-5 ml-3">Your membership</h1>
        <div class="row mt-2 mb-5">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                   your membership
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Including category</th>
                                <th>Bought at</th>
                                <th>Expired date</th>
                                <th>Remaining days</th>
                                <th>Status</th>
                            </tr>
                            </thead>
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th>ID</th>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Including category</th>--}}
{{--                                <th>Bought at</th>--}}
{{--                                <th>Expired date</th>--}}
{{--                                <th>Remaining days</th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
                            <tbody>


                                @foreach($memberships as $membership)
                                    <tr>
                                        <td>{{$membership->membership_id}}</td>
                                        <td>{{$membership->membership->name ?? ""}}</td>
                                        <td>@foreach($membership->categories as $category) <a href="">{{$category->name}}</a> , @endforeach</td>
                                        <td>{{$membership->created_at}}</td>
                                        <td>{{$membership->expired_date}}</td>
                                        <td style="text-align: center">
                                       {{ now()->diffInDays($membership->expired_date, false)}}
                                        </td>
                                        <td>@if($membership->expired_date > now())  Valid  @else Expired @endif</td>
                                    </tr>
                                @endforeach




                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable( {
                "paging":   false,

                "info":     false
            } );
        } );
    </script>
@endsection
