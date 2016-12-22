<div ng-controller="UserQuestionController" >
    <div  ng-repeat="item in User.questions">
        <h4> [: item.title :] </h4>
        <h5> [: item.desc :] </h5>
        <h6> [: item.created_at :] </h6>
    </div>
</div>


