<div class="container" ng-controller="QuestionAddController">
    <div class="card">
        [: Question.add_data :]
        <h1>提问</h1>
        <form ng-submit="Question.addQuestion()" name="question_add_form">
            <div>
                <label>问题</label>
                <input
                        ng-model="Question.add_data.title"
                        type="text"
                        name="title"
                        ng-minlength="4"
                        ng-maxlength="26"
                        required
                        >
                <div class="input-err-set" ng-if="signup_form.username.$touched">
                    <label ng-if="question_add_form.title.$error.required">此项为必填项</label>
                    <label ng-if="question_add_form.title.$error.minlength || signup_form.username.$error.maxlength"> 问题应在6-26位  </label>

                </div>
            </div>

            <div>
                <label>问题描述</label>
                    <textarea
                            ng-model="Question.add_data.desc"
                            type="text"
                            name="desc"

                            ></textarea>
            </div>
            <button
                    type="submit"
                    ng-disabled="question_add_form.$invalid"
                    > 提交</button>

        </form>
    </div>
</div>