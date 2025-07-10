@extends('admin.partials.master')
@section('admin_content')
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">
                            <div class="d-flex justify-content-between">
                                <div>{{$title}} Withdraw Lists</div>
                            </div>
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped dataex-html5-selectors">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>User</th>
                                        <th>Channel</th>
                                        <th>Address</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Active</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($withdraws as $key => $row)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <small>
                                                    Phone: {{$row->user->phone ?? '--'}}  <br>
                                                    Ref id: {{$row->user->ref_id ?? '--'}} <br>
                                                </small>
                                            </td>
                                            <td>
                                                {{$row->payment_method}}
                                            </td>
                                            <td width="100">
                                                <div style="width: 100px;overflow: hidden">
                                                    {{$row->number ?? '---'}}
                                                    <a href="javascript:void(0)" onclick="copyLink('{{$row->number}}')" class="btn btn-sm btn-primary">Copy</a>
                                                </div>
                                            </td>
                                            <td>
                                                <small>
                                                    Withdraw Amount: {{price($row->amount)}} <br>
                                                    Withdraw Charge: {{price($row->charge)}} <br>
                                                    Final Amount : {{price($row->final_amount)}}
                                                </small>
                                            </td>
                                            <td>
                                                <span class="badge @if($row->status == 'pending') badge-warning @elseif($row->status == 'approved') badge-success  @elseif($row->status == 'rejected') badge-danger @endif" style="font-size: 8px">{{$row->status}}</span>
                                            </td>
                                            <td>
                                                @if($row->status == 'pending')
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal{{$row->id}}" class="btn btn-success">Action</a>
                                                    <form action="{{route('withdraw.status.change', $row->id)}}" method="POST">@csrf
                                                        <div class="modal fade" id="myModal{{$row->id}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Action for withdraw</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="status">Status <small class="text-info"> You can change withdraw status link approved, rejected, pending is default </small> </label>
                                                                            <select name="status" required id="status" class="form-control">
                                                                                <option value="approved" @if($row->status == 'approved') selected @endif>Approved</option>
                                                                                <option value="rejected" @if($row->status == 'rejected') selected @endif>Rejected</option>
                                                                                <option value="pending" @if($row->status == 'pending') selected @endif>Pending</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>

                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <input type="submit" value="Submit" class="btn btn-primary">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @else
                                                    <div class="text-info">Already push a action</div>
                                                @endif

                                                    <a href="{{route('admin.customer.login', $row->id)}}"
                                                       target="_blank"
                                                       class="btn btn-info"
                                                       style="padding: 3px 7px;font-size: 20px"
                                                       data-toggle="tooltip" title='Login Into User Account'>
                                                        <i class="bx bx-user"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('alert-message')
    <script>
        function copyLink(text)
        {
            const body = document.body;
            const input = document.createElement("input");
            body.append(input);
            input.style.opacity = 0;
            input.value = text.replaceAll(' ', '');
            input.select();
            input.setSelectionRange(0, input.value.length);
            document.execCommand("Copy");
            input.blur();
            input.remove();
            message('Copied success..')
        }
    </script>
@endsection


