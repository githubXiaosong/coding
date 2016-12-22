<div class="login container" ng-controller="LoginController">

    <div class="card">
        <h1>登录</h1>
        [: User.login_data :]
        {{--因为signupdata是在User中的 所以用的话需要用User.signupdata--}}
        <form ng-submit="User.login()" name="login_form">
            <div>
                <label>用户名</label>
                <input
                        ng-model="User.login_data.username"
                        ng-model-options="{debounce:500}"
                        type="text"
                        name="username"
                        ng-minlength="4"
                        ng-maxlength="16"
                        required
                        >
            </div>
            <div>
                <label>密码</label>
                <input
                        ng-model="User.login_data.password"
                        type="password"
                        name="password"
                        ng-minlength="6"
                        ng-maxlength="16"
                        required
                        >
                <div class="input-err-set" >
                    <label ng-if="User.validateError">用户名或密码错误</label>
                </div>
            </div>

            <button
                    type="submit"
                    ng-disabled="login_form.$invalid"
                    > 提交</button>
        </form>
    </div>


</div>

