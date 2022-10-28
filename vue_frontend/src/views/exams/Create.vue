<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <CIcon icon="cil-drop"/>
          Create exam
        </CCardHeader>
        <CCardBody>
          <CRow>
            <CForm action="#" id="formCreate">
              <div class="row">
                <div class="col-8 mb-3">
                  <CFormLabel for="title">Title</CFormLabel>
                  <CFormInput type="text" id="title" v-model="title" required />
                </div>
                <div class="col-4 mb-3">
                  <CFormLabel for="minimum_score">Minimum Score</CFormLabel>
                  <CFormInput type="number" id="minimum_score" v-model="minimum_score" required />
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 mb-3">
                  <CFormLabel for="start_date">Start date</CFormLabel>
                  <Datepicker id="start_date" v-model="start_date"></Datepicker>
                </div>
                <div class="col-md-4 mb-3">
                  <CFormLabel for="end_date">End date</CFormLabel>
                  <Datepicker id="end_date" v-model="end_date"></Datepicker>
                </div>
                <div class="col-md-4 mb-3">
                  <CFormLabel for="count_down">Count down</CFormLabel>
                  <Datepicker id="count_down" v-model="count_down" timePicker />
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <CFormLabel for="description">Description</CFormLabel>
                  <CFormTextarea id="description" v-model="description" rows="3"></CFormTextarea>
                </div>
              </div>
              <div class="submit">
                <button type="submit" class="btn btn-success text-white float-end" @click="save">Save</button>
              </div>
            </CForm>
          </CRow>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import {APISettings} from '@/config/config';
import router from '@/router';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
  name: 'Create',
  components: {Datepicker},
  created() {
    // this.fetchData();
  },
  data() {
    return {
      title: null,
      minimum_score: null,
      start_date: null,
      end_date: null,
      count_down: null,
      description: null,
      errors: [],
    }
  },
  methods: {
    async save(e) {
      e.preventDefault();

      let data = {};
      data.title = this.title;
      data.minimum_score = this.minimum_score;
      data.start_date = this.start_date;
      data.end_date = this.end_date;
      data.count_down = this.count_down.hours + ':' + this.count_down.minutes + ':' + this.count_down.seconds;
      data.description = this.description;
      console.log(data);

      fetch('http://localhost/api' + '/exams/store', {
        method: 'POST',
        headers: APISettings.headers,
        body: JSON.stringify(data)
      })
        .then(function (response) {
          if (response.status !== 200) {
            throw response.status;
          } else {
            router.push({name: 'Exams'}).catch(err => { console.log(err) });
          }
        })
        .then(function () {
          // this.$router.push('/questions')
        })
        .catch(console.error)
    },
  }
}
</script>

<style scoped>

</style>
