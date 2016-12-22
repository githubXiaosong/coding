<div class="signup container" ng-controller="UserController">
    <div class="card" >
        <h1>[: User.userInfo.username :]</h1>
        <h4>提过的问题:[: User.userInfo.question_num :]</h4>
        <h4>关注的问题:[: User.userInfo.question_focus :]</h4>
        <h4>回答:[: User.userInfo.answer_num :]</h4>

    </div>


        <div class="card  user-ind "  >

            <a href="#user/[: userid :]/question">
                <div class="btn  [: User.currentPage==1?'btn-act':0 :] ">
                  提问
                </div>
            </a>

            <a href="#user/[: userid :]/answer">
                <div class="btn  [: User.currentPage==2?'btn-act':0 :]">
                    回答
                </div>
            </a>

        </div>

    <div ui-view/>





</div>