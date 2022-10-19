<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <CIcon icon="cil-drop"/>
          Preview question
        </CCardHeader>
        <CCardBody>
          <CRow>
            <div class="col-12">
              <FillTheBlank v-if="view===1" :question="question" :answers="answers"></FillTheBlank>
<!--              <OneChoice v-if="view==='2'"></OneChoice>-->
<!--              <MultipleChoice v-if="view==='3'"></MultipleChoice>-->
<!--              <TrueFalse v-if="view==='4'"></TrueFalse>-->
            </div>
          </CRow>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>
<script>
import FillTheBlank from "@/views/questions/preview-components/FillTheBlank";
import {APISettings} from '@/config/config';


export default {
  name: 'Preview',
  components: { FillTheBlank },
  created() {
    this.fetchData();
  },
  data() {
    return {
      view: NaN,
      id: this.$route.params.id,
      question: '',
      answers: '',
    }
  },
  methods: {
    fetchData() {
      let fetchData = fetch('http://localhost/api' + '/question/preview/'+this.id, {
        method: 'GET',
        headers: APISettings.headers
      })
        .then(function (response) {
          if (response.status !== 200) {
            throw response.status;
          } else {
            return response.json();
          }
        });
      fetchData.then(data => {
        this.view = data.question.type
        this.question = data.question
        this.answesr = data.answers
      })
    }
  },
}
</script>
