@extends('page.user.index')



@section('content_user')
    <div class="panel panel-default big-panel" ng-controller="UserLiveController">



        <div class="panel-body">
            @if($live)

                {{--三个修改的模态框--}}
                <div class="modal fade"  tabindex="-1" role="dialog" id="bs-change-title">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">修改标题</h4>
                            </div>
                            <form ng-submit="changeTitle()">
                                <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="recipient-name" value="{{ $live->title }}">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    <button type="submit" class="btn btn-primary">确定</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="modal fade"  tabindex="-1" role="dialog" id="bs-change-desc">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">修改描述</h4>
                            </div>
                            <form ng-submit="changeDesc()">
                                <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="recipient-name" value="{{ $live->desc }}">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    <button type="submit" class="btn btn-primary">确定</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="modal fade"  tabindex="-1" role="dialog" id="bs-change-category">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">修改分类</h4>
                            </div>
                            <form ng-submit="changeCategory()">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="recipient-name" value="{{ $live->category->title }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    <button type="submit" class="btn btn-primary">确定</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态</label>

                        <div class="col-sm-10">
                            <p class="form-control-static">
                                @if($live->status == 0)

                            <p class="text-danger">未推流</p>
                            @elseif($live->status == 1)
                                <p class="text-success">推流中</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">rtmp地址</label>

                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $live->pushaddr }}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">分类</label>

                        <div class="col-sm-10">
                            <div class="input-group ">
                                <p class="form-control-static">
                                    {{$live->category->title}} </p>
                              <span class="input-group-btn">
                                <button id="user-live-category-tog" class="btn btn-default btn-sm" type="button"
                                        data-toggle="modal" data-target="#bs-change-category"
                                        >修改
                                </button>
                              </span>

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">标题</label>

                        <div class="col-sm-10">
                            <div class="input-group ">
                                <p class="form-control-static">
                                    {{$live->title}} </p>
                              <span class="input-group-btn">
                                <button id="user-live-title-tog" class="btn btn-default btn-sm" type="button"
                                        data-toggle="modal" data-target="#bs-change-title"
                                        >修改
                                </button>
                              </span>

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">描述</label>

                        <div class="col-sm-10">
                            <div class="input-group ">
                                <p class="form-control-static">
                                    {{$live->desc}} </p>
                              <span class="input-group-btn">
                                <button id="user-live-desc-tog" class="btn btn-default btn-sm" type="button"
                                        data-toggle="modal" data-target="#bs-change-desc"
                                        >修改</button>
                              </span>



                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">房间设置</label>

                        <div class="col-sm-10">
                            <div class="btn-group tab-group" role="group">
                                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                    <button type="button" class="btn btn-default active ">管理员</button>
                                </a>
                                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                    <button type="button" class="btn btn-default ">黑名单</button>
                                </a>
                                <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
                                    <button type="button" class="btn btn-default ">IP屏蔽</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">
                            <div role="tabpanel">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>管理员</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>
                                                    <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                                        <button type="button" class="btn btn-default">Left</button>
                                                        <button type="button" class="btn btn-default">Middle</button>
                                                        <button type="button" class="btn btn-default">Right</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>
                                                    <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                                        <button type="button" class="btn btn-default">Left</button>
                                                        <button type="button" class="btn btn-default">Middle</button>
                                                        <button type="button" class="btn btn-default">Right</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>禁收</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>
                                                    <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                                        <button type="button" class="btn btn-default">Left</button>
                                                        <button type="button" class="btn btn-default">Middle</button>
                                                        <button type="button" class="btn btn-default">Right</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>
                                                    <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                                        <button type="button" class="btn btn-default">Left</button>
                                                        <button type="button" class="btn btn-default">Middle</button>
                                                        <button type="button" class="btn btn-default">Right</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="messages">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>IP</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>
                                                    <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                                        <button type="button" class="btn btn-default">Left</button>
                                                        <button type="button" class="btn btn-default">Middle</button>
                                                        <button type="button" class="btn btn-default">Right</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>
                                                    <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                                        <button type="button" class="btn btn-default">Left</button>
                                                        <button type="button" class="btn btn-default">Middle</button>
                                                        <button type="button" class="btn btn-default">Right</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="alert alert-danger" role="alert" ng-if="createLiveErrors">
                    <ul>
                        <div ng-repeat="errors in createLiveErrors">
                            <li ng-repeat="err in errors">[: err :]</li>
                            <br>
                        </div>
                    </ul>
                </div>

                <form ng-submit="createLive()" name="createLiveForm">
                    <div class="form-group">
                        <label for="exampleInputEmail1">房间标题</label>
                        <input type="text"
                               ng-model="createLiveData.title"
                               name="title"
                               class="form-control"
                               id="exampleInputEmail1"
                               placeholder="30字以内"
                               maxlength="30"
                               required
                                >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">房间描述</label>
                        <input type="text"
                               name="desc"
                               ng-model="createLiveData.desc"
                               class="form-control"
                               id="exampleInputPassword1"
                               placeholder="10-100字之内"
                               maxlength="100"
                               required
                                >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">技术类型</label>
                        <select  ng-model="createLiveData.category" class="form-control"  required>
                            @foreach($categories as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="accept" ng-model="createLiveData.accept"> 我同意协议
                        </label>
                    </div>

                    <button type="submit" class="btn btn-default">创建房间</button>
                </form>
            @endif
        </div>
    </div>


@stop
