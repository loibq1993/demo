<template>
  <div class="form-control mb-4 multiple-input">
    <div v-for="(answerAlterEl, index) in answerAlterEls" :key="index">
      <div class="alter-answer">
        <div class="label-form mb-1">
          <span>Answer *</span>
        </div>
        <div class="content-input row">
          <div class="col-3">
            <Select :title="selectField" :options="options"></Select>
          </div>
          <Input class="col-7" :title="title" :placeholder="placeholder.answer" :type="'text'" @keyup="countWord"></Input>
          <div class="input-limit col-2">
            <Input :placeholder="placeholder.limit" :type="'number'" :title="limitText" @keypress="isNumber($event)"></Input>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-4 row">
      <div class="col-12">
        <button class="btn btn-light col-4 w-auto float-end" type="button" @click="addAlterAnswers">
          <i class="fa fa-plus"></i>
          <span> Add an alternative answer</span>
        </button>
      </div>
    </div>
    <div class="content-input">
      <textarea :name="explanation" class="w-100" placeholder="Explanation for answer"></textarea>
    </div>
  </div>
</template>

<script>
import Select from "@/views/components/Select";
import Input from "@/views/components/Input";

export default {
  name: 'InputFillTheBlank',
  components: {Select, Input},
  props: ['title', 'selectField', 'explanation', 'limitText'],
  data() {
    return {
      options: [
        {index: 1, value: 'is exactly'},
        {index: 2, value: 'contains'},
        {index: 3, value: 'exact number'},
      ],
      answerAlterEls: [0],
      placeholder: {
        answer: "Input the answer here",
        limit: "Limit number text"
      },
    }
  },
  methods: {
    addAlterAnswers() {
      this.answerAlterEls.push(0)
    },
    countWord(event){
      let count = 0;
      event.target.value.split(" ").map(function (text) {
        if (text.trim().length > 0) ++count
      })
      let limitInput = event.target.closest('.content-input').getElementsByClassName('input-limit')[0].getElementsByTagName('input')[0]
      limitInput.value = count
    },
    isNumber (evt) {
      const keysAllowed = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
      const keyPressed = evt.key;

      if (!keysAllowed.includes(keyPressed)) {
        evt.preventDefault()
      }
    }
  }
}
</script>
