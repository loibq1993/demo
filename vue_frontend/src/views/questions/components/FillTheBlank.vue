<template>
  <div id="fill_the_blank">
    <div class="question mb-4" @keyup="getQuestion">
      <ckeditor :editor="editor" :config="editorConfig"></ckeditor>
    </div>
    <div class="answers col-12">
      <div v-for="(answerEl, index) in answerEls" :key="index">
        <InputFillTheBlank v-model="answerEls[index]" :title="title+'['+answerEl.count+']'"
                           :explanation="explanation+'['+answerEl.count+']'"
                           :select-field="selectField+'['+answerEl.count+']'"
                           :limit-text="limitText+'['+answerEl.count+']'"
        ></InputFillTheBlank>
      </div>
    </div>
    <div class="button-add-answer offset-6">
      <div class="add-form-control">
        <button href="#" class="btn btn-success btn-circle" type="button" @click="addAnswer"><i class="fa fa-plus"></i>
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import UploadAdapter from '../../../assets/upload';
import InputFillTheBlank from "@/views/questions/components/InputFillTheBlank";

export default {
  name: 'FillTheBlank',
  components: {InputFillTheBlank},
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', '|', 'numberedList', 'bulletedList', '|', 'undo', 'redo', 'uploadImage', '|', 'insertTable', 'ckfinder', 'outdent', 'indent', '|',],
        extraPlugins: [UploadAdapter],
        ckfinder: {
          // Upload the images to the server using the CKFinder QuickUpload command.
          uploadUrl: window.location + '/upload',
          options: {
            resourceType: 'Files',
          }
        }
      },
      title: 'answer[value]',
      explanation: 'answer[explanation]',
      selectField: 'answer[selectField]',
      limitText: 'answer[limitText]',
      answerEls: [{
        count: 0
      }],
      question: ''
    };
  },
  methods: {
    addAnswer() {
      this.answerEls.push({count: this.answerEls.length})
    },
    getQuestion(value) {
      this.$emit('childToParent', value.originalTarget.innerHTML)
    },
  },
}
</script>
