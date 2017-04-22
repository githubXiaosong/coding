@extends('page.keda.index')



@section('content_pet')
    <div ng-controller="KedaAddController">

        <div class="alert alert-success" role="alert" ng-show="isSucceed == 1">
            <a href="#" class="alert-link">添加成功！</a>
        </div>

        <div class="alert alert-warning" role="alert" ng-show="isSucceed == 2 ">
            <a href="#" class="alert-link">添加失败！</a> <br>
            log [: errorInfo :]

            (不清楚联系请开发者)
        </div>

        <form ng-submit="addPet()" name="add_per_form">
            <div class="form-group">
                <label for="exampleInputEmail1">昵称</label>
                <input type="text" name="name" class="form-control" ng-model="petInfo.name"  ng-maxlength="30" required>

                <span style="color:red" ng-show="add_per_form.name.$dirty && add_per_form.name.$invalid ">
                 <span ng-show=" add_per_form.name.$error.maxlength ">昵称长度应该在30字节以下的中文 字母 或者 数字</span>
                </span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">年龄</label>

                <select class="form-control"  name="age" ng-model="petInfo.age"  >
                    <option selected="selected" >1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                    <option>13</option>
                    <option>14</option>
                    <option>15</option>
                    <option>16</option>
                    <option>17</option>
                    <option>18</option>
                    <option>19</option>
                    <option>20</option>
                    <option>21</option>
                    <option>22</option>
                    <option>23</option>
                    <option>24</option>
                    <option>25</option>
                    <option>26</option>
                    <option>27</option>
                    <option>28</option>
                    <option>29</option>
                    <option>30</option>
                    <option>31</option>
                    <option>32</option>
                    <option>33</option>
                    <option>34</option>
                    <option>35</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">种类</label>

                <p class="text-muted">这个应该是选的 但是我嫌太麻烦了 就直接输入文字吧 切实需要在给我讲 。。。</p>
                <input type="text" class="form-control" name="category" ng-model="petInfo.category" ng-maxlength="15" required>
                <span style="color:red" ng-show="add_per_form.category.$dirty && add_per_form.category.$invalid ">
                 <span ng-show=" add_per_form.category.$error.maxlength ">种类长度应该在15字节以下的中文 字母 或者 数字</span>
                </span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">头像</label>

                <p class="text-muted">图片先不要传上来 空着别动就行了</p>
                <input type="file" id="exampleInputFile" name="avatar">
            </div>

            <button type="submit" class="btn btn-default" style="float: right">添加</button>
        </form>
    </div>
@stop
