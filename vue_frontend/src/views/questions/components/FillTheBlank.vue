<template>
  <div id="fill_the_blank">
    <div class="question mb-4">
      <ckeditor :editor="editor" v-model="editorData" :config="editorConfig" v-bind:class="'bcd'"></ckeditor>
    </div>
    <div class="answers">
      <div v-for="(answerEl, index) in answerEls" :key="index" class="row">
        <div class="display-number-answer col-1">
          <div class="numberCircle">{{index+1}}</div>
        </div>
        <div class="col-11">
          <InputFillTheBlank v-model="answerEls[index]" :title="title+'['+answerEl.count+']'"
                              :explanation="explanation+'['+answerEl.count+']'"
                              :select-field="selectField+'['+answerEl.count+']'"
                              :limit-text="limitText+'['+answerEl.count+']'"
          ></InputFillTheBlank>
        </div>
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
      editorData: '',
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
  },
  watch: {
    editorData: function(val) {
      this.$emit('childToParent', val);
    },
  },
}
</script>
<style scoped>
.numberCircle {
  border-radius: 50%;
  width: 36px;
  height: 36px;
  background: #fff;
  border: 2px solid #666;
  color: #666;
  text-align: center;
  font-size: 20px;
  margin: 0 auto
}
</style>
