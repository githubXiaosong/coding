<div ng-controller="UserAnswerController">
    <div  ng-repeat="item in User.answers">
        <h4> [: item.question.title :] </h4>
        <h5> [: item.content :] </h5>
        <h6> [: item.created_at :] </h6>
    </div>
</div>
