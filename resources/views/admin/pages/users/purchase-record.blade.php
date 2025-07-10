@extends('admin.partials.master')
@section('admin_content')
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">
                            <div class="d-flex justify-content-between">
                                <div>Customers Lists</div>
                                <div>
                                    <a href="{{route('admin.search.user')}}" class="btn btn-success"><i class="bx bx-user"></i> Search A User</a>
                                </div>
                            </div>
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Photo</th>
                                        <th>Referral id</th>
                                        <th>Name</th>
                                        <th>VIP Name</th>
                                        <th>Purchase Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($purchases as $key => $row)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <a href="{{asset($row->user->photo ? view_image($row->user->photo) : not_found_img())}}"
                                                   target="_blank">
                                                    <img width="40"
                                                         src="{{asset($row->user->photo ? view_image($row->user->photo) : not_found_img())}}"
                                                         alt="Package Photo">
                                                </a>
                                            </td>
                                            <td>{{$row->user->ref_id}}</td>
                                            <td>{{$row->user->name ?? $row->user->username}}</td>
                                            <td>{{$row->package->name}} @if($row->package->is_default == '1') <span class="text-danger " style="font-size: 10px">Is_Default</span> @endif</td>
                                            <td>{{$row->created_at}}</td>
                                            <td>{{$row->status}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{$purchases->links("pagination::bootstrap-4")}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


