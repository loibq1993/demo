<template>
  <div id="fill_the_blank">
    <div class="question">
      <div class="title form-label" style="font-weight: bold">{{question.title}}</div>
      <div class="content">
        <div v-html="questionHTML"></div>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  name: 'FillTheBlank',
  props: [ 'question', 'answers' ],
  computed: {
    questionHTML () {
      let html = this.question.question
      console.log(html)
      return html.replaceAll('___', '<input type="text" name="value[]" class="replaced-input" style="width: 50px"/>');
    }
  }
}
</script>
