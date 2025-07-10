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
                            <div class="mes">

                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped dataex-html5-selectors">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Referral id</th>
                                        <th>Team Invest</th>
                                        <th>Team size</th>
                                        <th>bonus</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Models\TaskRequest::orderByDesc('id')->get() as $key => $row)
                                        <?php
                                        $task = \App\Models\Task::where('id', $row->task_id)->first();
                                        $user = \App\Models\User::where('id', $row->user_id)->first();
                                        ?>
                                        @if($task && $user)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$user->ref_id}}</td>
                                                <td>{{$row->team_invest}}</td>
                                                <td>{{$row->team_size}}</td>
                                                <td>{{price($row->bonus)}}</td>
                                                <td>{{$row->status}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection





