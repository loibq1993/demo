<template>
  <div class="fill_the_blank mb-5">
    <div class="question">
      <div class="title form-label" style="font-weight: bold">Question {{index}}: {{ question.title }}</div>
      <div class="content">
        <div v-html="questionHTML"></div>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  name: 'FillTheBlank',
  props: ['question', 'index'],
  data() {
    return {
      answers: []
    }
  },
  computed: {
    questionHTML() {
      let html = this.question.question
      let answers = this.question.full_answers
      for (let i = 0; i < answers.length; i++) {
        let limit = answers[i].correct_answers[0].correct_answer_detail.correct_answer.length
        html = html.replace('___', '<input type="text" name="answers_'+answers[i].id+'[]" class="replaced-input" style="width: '+limit+'0px"/>');
      }
      return html
    }
  },
  methods: {

  }
}
</script>
