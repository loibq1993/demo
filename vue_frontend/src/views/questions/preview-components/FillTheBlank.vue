<template>
  <div id="fill_the_blank">
    <div class="question">
      <div class="title form-label" style="font-weight: bold">{{ question.title }}</div>
      <div class="content">
        <div v-html="questionHTML"></div>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  name: 'FillTheBlank',
  props: ['question', 'answers'],
  computed: {
    questionHTML() {
      let html = this.question.question
      let answers = this.answers
      for (let i = 0; i < answers.length; i++) {
        let limit = answers[i].correct_answers[0].correct_answer_detail.correct_answer.length
        console.log(limit)
        html = html.replace('___', '<input type="text" name="value[]" class="replaced-input" style="width: '+limit+'0px"/>');
      }
      return html
    }
  },
  methods: {

  }
}
</script>
