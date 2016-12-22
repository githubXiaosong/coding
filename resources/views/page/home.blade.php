<div class="home container" ng-controller="HomeController" >
    <h1>最新动态</h1>

    <div class="item-set">
        <div class="item" ng-repeat="item in Timeline.data">
            <hr/>

            <div class="item-content">

                <a href="#/question/details/[:item.question.id:]">
                    <h3 class="content-title"> <strong>[: item.question.title :]</strong> </h3>
                </a>
                <h6 class="content-act">XXX,XXX,XXX等赞同了该回答</h6>
                <div class="left-set">
                  {{--item.hasUp [: item.answer.hasUp :]--}}
                    {{--item.hasDown  [: item.answer.hasDown :]--}}
                    <button ng-disabled="item.answer.hasUp "  ng-click="Timeline.setVote(1,item.answer.id)" class="glyphicon glyphicon-hand-up" style="color: rgb(207, 0, 0); font-size: 18px;">  [: item.answer.timesUp :] </button>
                    <button ng-disabled="item.answer.hasDown "  ng-click="Timeline.setVote(2,item.answer.id)" class="glyphicon glyphicon-hand-down" style="color: rgb(207, 0, 0); font-size: 18px;"> [: item.answer.timesDown :]</button>
                </div>
                <div class="content-owner">
                    <h4 class="content-owner-name ">[: item.answer.user.username :]</h4>
                    <h6 ng-show="item.user.desc" class="content-owner-desc">[: item.answer.user.desc :]</h6>
                    <h6 ng-hide="item.user.desc" class="content-owner-desc">他没有签名哈哈哈</h6>
                </div>

                <div class="content-main text-warning" >
                    {{--有question_id 的是个回答 没有的是个问题--}}
                    <p ui-sref="answer.details({answer_id:item.answer.id})">
                        [: item.answer.content :]
                    </p>

                </div>

            </div>
            <div class="text-muted"> <strong>评论</strong> </div>
            <div class="comment-set">

                <div class="comment-item clearfix"   ng-show="[: item.comment[0] :]"  ng-repeat="com in item.comment " >
                    <h5 class="comment-item-name"><i> [: com.user.username :] </i></h5>
                    <div class="comment-item-content text-muted">
                        <p>[: com.content :]</p>
                    </div>
                </div>

                <div ng-hide="[: item.comment[0] :]"  class="default-comment ">
                    <p>来个人评论啊!</p>
                </div>

            </div>
        </div>
    </div>
    <div class="refresh-show">
        <p ng-if="Timeline.noMore">没有更多数据了~~~</p>
        <p ng-if="Timeline.isBusy">正在加载......</p>
    </div>

</div>