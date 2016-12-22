<div class="signup container" ng-controller="SignupController">
    <div class="card">
        <h1>注册</h1>
        [: User.signup_data :]
        {{--因为signupdata是在User中的 所以用的话需要用User.signupdata--}}
        <form ng-submit="User.signup()" name="signup_form">
            <div>
                <label>用户名</label>
                <input
                        ng-model="User.signup_data.username"
                        ng-model-options="{debounce:500}"
                        type="text"
                        name="username"
                        ng-minlength="4"
                        ng-maxlength="16"
                        required
                        >
                <div class="input-err-set" ng-if="signup_form.username.$touched">
                    <label ng-if="User.signup_username_exists">用户名已存在</label>
                    <label ng-if="signup_form.username.$error.required">用户名为必填</label>
                    <label ng-if="signup_form.username.$error.minlength || signup_form.username.$error.maxlength"> 用户名应在6-26位  </label>

                </div>
            </div>
            <div>
                <label>密码</label>
                <input
                        ng-model="User.signup_data.password"
                        type="password"
                        name="password"
                        ng-minlength="6"
                        ng-maxlength="16"
                        required
                        >
                <div class="input-err-set" ng-if="signup_form.password.$touched">
                    <label ng-if="signup_form.password.$error.required">密码名为必填</label>
                    <label ng-if="signup_form.password.$error.minlength || signup_form.password.$error.maxlength" >密码应在6-26位></label>
                </div>
            </div>
            <button
                    type="submit"
                    ng-disabled="signup_form.$invalid || User.signup_username_exists"
                    > 提交</button>
        </form>
    </div>

</div>