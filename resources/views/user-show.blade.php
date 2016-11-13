@extends('layouts.dashboard')

@section('content')
        <!-- page content -->
          <div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kelola Pengguna</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" ng-app="">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Profil Pengguna</h2>
                          <div class="clearfix"></div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="profile_img col-md-5 col-sm-12 col-xs-12">
                            <div id="crop-avatar">
                              <!-- Current avatar -->
                              <img class="img-responsive avatar-view" src="{{ asset('/img/pui.png') }}" alt="Avatar" title="Change the avatar">
                            </div>
                          </div>
                          <div class="col-md-7 col-sm-12 col-xs-12">
                            <h3 ng-bind="fullname || 'Nama Pengguna'" style="text-transform: capitalize;"></h3>
                            <div style="margin-top:-8px;margin-bottom:4px"><span style="">ID :</span> <span ng-bind="username || 'ID Pengguna'">{{ $user->_id}}</span></div>
                            <table>
                              <tr>
                                <td><i class="fa fa-briefcase"></i>&nbsp;Lembaga </td>
                                <td> :&nbsp; {{ $user->name }}</td>
                              </tr>
                              <tr>
                                <td><i class="fa fa-user"></i>&nbsp;Username </td>
                                <td> :&nbsp; {{ $user->username}}</td>
                              </tr>
                              <tr>
                                <td><i class="fa fa-envelope"></i>&nbsp;Email </td>
                                <td> :&nbsp; {{ $user->email}}</td>
                              </tr>
                            </table>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->
        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        @endsection
        
        @push('scripts')
        {!! Html::style('vendors/jquery-nice-select/css/nice-select.css'); !!}
        {!! Html::script('vendors/jquery-nice-select/js/jquery.nice-select.js'); !!}
        <script type="text/javascript">
          $(document).ready(function() {
            $('#nice-select').niceSelect();
          });
        </script>
        @endpush